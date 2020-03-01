function ajaxReload(obj, selector) {
  var method = obj.method ? obj.method : 'GET';
  var url = obj.url;
  var async = obj.async ? obj.async : true;
  var user = obj.user ? obj.user : null;
  var password = obj.password ? obj.password : null;
  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var d = document.createElement("div");
      d.innerHTML = x.responseText; //console.log(x);

      document.querySelector(selector).innerHTML = d.querySelector(selector).innerHTML;
      return true;
    } else if (this.status != 200) {
      //console.log(this.responseText);
      return false;
    }
  };

  x.open(method, url, async, user, password);

  if (method == 'POST') {
    x.send(obj.data);
  } else {
    x.send();
  }

  return null;
}

function returnNull() {
  return null;
}

function ajaxRequest(obj) {
  var method = obj.method ? obj.method : 'GET';
  var url = obj.url;
  var async = obj.async ? obj.async : true;
  var user = obj.user ? obj.user : null;
  var password = obj.password ? obj.password : null;
  var headers = obj.headers ? obj.headers : {};
  var before = obj.before ? obj.before : returnNull;
  var success = obj.success ? obj.success : returnNull;
  var failure = obj.failure ? obj.failure : returnNull;
  var complete = obj.complete ? obj.complete : returnNull;
  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (this.readyState == 4) {
      before(this);
      console.log(this.status);

      if (this.status == 200) {
        success(this);
      } else {
        failure(this);
      }

      complete(this);
    }
  };

  x.open(method, url, async, user, password);

  for (var type in headers) {
    x.setRequestHeader(type, headers[type]);
  }

  x.send(obj.data);
  return null;
}

function onClick(sel, fn) {
  document.addEventListener("click", function (e) {
    if (e.target.matches(sel)) {
      fn(e);
    }
  });
}

function onChange(sel, fn) {
  document.addEventListener("change", function (e) {
    if (e.target.matches(sel)) {
      fn();
    }
  });
}

function toQueryString(sel) {
  var qs = [];
  qs[0] = sel + " input:not([disabled]):not([type=radio])";
  qs[1] = sel + " input[type=radio]:not([disabled]):checked";
  qs[2] = sel + " textarea:not([disabled])";
  qs = qs.join();
  var queryString = "";
  var qr = document.querySelectorAll(qs);
  qr.forEach(function (i) {
    queryString += "&" + i.name + "=" + i.value;
  });
  var selects = document.querySelectorAll(sel + " select:not([disabled])");
  selects.forEach(function (i) {
    queryString += "&" + i.name + "=" + i.querySelector("option:not([disabled]):checked").value;
  }); //console.log(queryString);

  return encodeURI(queryString);
}

function planSave() {
  var m_id = document.querySelector("[name=id]").value;
  var d = toQueryString("#plan-form");
  ajaxRequest({
    method: "PUT",
    headers: {
      'Content-type': 'application/x-www-form-urlencoded',
      'Accept': 'application/json'
    },
    url: "/plan/save/" + m_id,
    data: d,
    before: function before() {
      document.querySelector(".plan__success").innerHTML = "";
      document.querySelector(".plan__errors").innerHTML = "";
    },
    success: function success() {
      document.querySelector(".plan__success").textContent = "Meeting saved successfully";
    },
    failure: function failure(x) {
      var errors = JSON.parse(x.responseText).errors;
      var ul = document.createElement("ul");

      for (var name in errors) {
        var li = document.createElement("li");
        li.textContent = name + ": " + errors[name];
        ul.append(li);
      }

      document.querySelector(".plan__errors").append(ul);
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  // Tabbing around
  onClick(".tab-bar .tab", function (e) {
    var clickedTab = e.target;
    var clickedTabIndex = clickedTab.getAttribute("tab-index");
    var clickedTabBar = e.target.closest(".tab-bar");
    var clickedTabBarId = clickedTabBar.id;
    var otherTabs = clickedTabBar.querySelectorAll(".tab");
    var controllees = document.querySelectorAll("[controlled-by=\"" + clickedTabBarId + "\"]");
    otherTabs.forEach(function (tab) {
      tab.classList.remove("active");
    });
    clickedTab.classList.add("active");
    controllees.forEach(function (tabBodyBar) {
      tabBodyBar.querySelectorAll(".tab-body").forEach(function (tabBody) {
        console.log(tabBody);

        if (tabBody.getAttribute("tab-index") == clickedTabIndex) {
          tabBody.classList.add("active");
        } else {
          tabBody.classList.remove("active");
        }
      });
    });
  }); // For meetings and next steps tab, keep a record of what tab's open

  onClick("#meetings-tab .tab", function (e) {
    document.querySelector("[name=meeting\\[tab\\]]").value = e.target.getAttribute("tab-index");
  });
  onClick("#next-steps-tab .tab", function () {
    document.querySelector("[name=next-step\\[tab\\]]").value = e.target.getAttribute("tab-index");
  });
  onClick(".tab-sort-filter__sort-toggle", function () {
    e.target.parentElement.querySelector(".tab-sort-filter__filters").classList.remove("active");
    e.target.parentElement.querySelector(".tab-sort-filter__sorts").classList.toggle("active");
  });
  onClick(".tab-sort-filter__filter-toggle", function () {
    e.target.parentElement.querySelector(".tab-sort-filter__sorts").classList.remove("active");
    e.target.parentElement.querySelector(".tab-sort-filter__filters").classList.toggle("active");
  });
  onChange("#mns-form .meetings-ajax", function () {
    console.log("/ajax/my_meetings?" + toQueryString("#mns-form"));
    ajaxReload({
      url: "/ajax/my_meetings?" + toQueryString("#mns-form")
    }, ".mns-meeting-list");
  });
  onChange("#mns-form .next-steps-ajax", function () {
    console.log("/ajax/my_next_steps?" + toQueryString("#mns-form"));
    ajaxReload({
      url: "/ajax/my_next_steps?" + toQueryString("#mns-form")
    }, ".mns-next-step-list");
  });
  onChange("#plan-form input, #plan-form select, #plan-form textarea", function () {
    planSave();
  });
  onClick("#plan-form #add-attendee", function () {
    document.querySelector(".plan__attendees").innerHTML += document.getElementById("new-attendee").innerHTML;
  });
  onClick("#plan-form #add-guest", function () {
    document.querySelector(".plan__guests").innerHTML += document.getElementById("new-guest").innerHTML;
  });
  onClick("#plan-form #add-objective", function () {
    ajaxRequest({
      url: "/ajax/plan_add_objective",
      success: function success(d) {
        console.log(d);
        document.querySelector(".plan__objectives").innerHTML += d.response;
      }
    });
  });
  onClick("#plan-form #add-day", function () {
    ajaxRequest({
      url: "/ajax/plan_add_day",
      success: function success(d) {
        console.log(d);
        document.querySelector(".plan__days").innerHTML += d.response;
      }
    });
  }); // Handler when the DOM is fully loaded

  console.log("Loaded");
});
/*

$(document).ready(function() {

  $(document).on("change", "#run-form .meetings-ajax input", function() {
    //console.log($(this));
    $.ajax({
      method: 'GET',
      url: '/ajax/my_meetings_run',
      data: $("#run-form").serialize(),
      success: function(d, ts, xhr) {
        $(".meetings-ajax .tab-body-bar").html($(d).find(".tab-body-bar").html());
      },
      error: function(x, t, e){
        $(".ajax").html(x);
        $(".ajax").append(t);
        $(".ajax").append(e);
      }
    });
  });


});
*/
