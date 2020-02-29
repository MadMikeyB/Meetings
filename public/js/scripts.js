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
      console.log(this.responseText);
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

function ajaxCall(obj) {
  var method = obj.method ? obj.method : 'GET';
  var url = obj.url;
  var async = obj.async ? obj.async : true;
  var user = obj.user ? obj.user : null;
  var password = obj.password ? obj.password : null;
  var headers = obj.headers ? obj.headers : {};
  var x = new XMLHttpRequest();

  x.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        return x;
      } else {
        console.error(this);
      }
    }
  };

  console.log(headers);
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
      fn();
    }
  });
}

function onChange(sel, fn) {
  document.addEventListener("change", function (e) {
    if (e.target.matches(sel)) {
      fn();
    }
  });
  /*
  document.querySelectorAll(sel).forEach(function(el) {
    el.addEventListener("change", fn)
  })
  */
}

function toQueryString(sel) {
  var qs = [];
  qs[0] = sel + " input:not([disabled]):not([type=radio])";
  qs[1] = sel + " input[type=radio]:not([disabled]):checked";
  qs[2] = sel + " textarea:not([disabled])";
  qs = qs.join();
  var queryString = "";
  var qr = document.querySelectorAll(qs);
  console.log(qr);
  qr.forEach(function (i) {
    console.log(i.name, encodeURI(i.name), i.value, encodeURI(i.value));

    if (i.value) {
      queryString += "&" + i.name + "=" + i.value;
    }
  });
  var selects = document.querySelectorAll(sel + " select:not([disabled])");
  selects.forEach(function (i) {
    console.log(i.name, encodeURI(i.name), i.value, encodeURI(i.value));
    queryString += "&" + i.name + "=" + i.querySelector("option:not([disabled]):checked").value;
  });
  return encodeURI(queryString);
}

document.addEventListener("DOMContentLoaded", function () {
  // Tabbing around
  onClick(".tab-bar .tab", function () {
    console.log("Click!");
    var clickedTab = this;
    var clickedTabIndex = clickedTab.getAttribute("tab-index");
    var clickedTabBar = this.closest(".tab-bar");
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

  onClick("#meetings-tab .tab", function () {
    document.querySelector("[name=meeting\\[tab\\]]").value = this.getAttribute("tab-index");
  });
  onClick("#next-steps-tab .tab", function () {
    document.querySelector("[name=next-step\\[tab\\]]").value = this.getAttribute("tab-index");
  });
  onClick(".tab-sort-filter__sort-toggle", function () {
    this.parentElement.querySelector(".tab-sort-filter__filters").classList.remove("active");
    this.parentElement.querySelector(".tab-sort-filter__sorts").classList.toggle("active");
  });
  onClick(".tab-sort-filter__filter-toggle", function () {
    this.parentElement.querySelector(".tab-sort-filter__sorts").classList.remove("active");
    this.parentElement.querySelector(".tab-sort-filter__filters").classList.toggle("active");
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
    var m_id = document.querySelector("[name=id]").value;
    console.log(m_id);
    var d = toQueryString("#plan-form");
    console.log(d);
    console.log($("#plan-form").serialize());
    ajaxCall({
      method: "PUT",
      headers: {
        'Content-type': 'application/x-www-form-urlencoded'
      },
      url: "/plan/save/" + m_id,
      data: d
    });
  });
  onClick("#plan-form #save-button", function () {
    var m_id = document.querySelector("[name=id]").value;
    console.log(m_id);
    var d = toQueryString("#plan-form");
    console.log(d);
    ajaxCall({
      method: "PUT",
      headers: {
        'Content-type': 'application/x-www-form-urlencoded'
      },
      url: "/plan/save/" + m_id,
      data: d
    });
  });
  onClick("#plan-form #add-attendee", function () {
    document.querySelector(".attendees__col").innerHTML += document.getElementById("new-attendee").innerHTML;
  });
  onClick("#plan-form #add-guest", function () {
    document.querySelector(".guests__col").innerHTML += document.getElementById("new-guest").innerHTML;
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



  $("#plan-form").on("change", "input, select, textarea", function(e) {
    e.preventDefault();
    let m_id = $("[name=id]").val();
    console.log(m_id);
    $.ajax({
      url: "/plan/save/" + m_id,
      data: $("#plan-form").serialize(),
      method: "PUT",
      success: function(d, x, t){
        console.log("Success");
        $(".flex-fill").html(d);
      }
    });
  });

  $(document).on("click", "#plan-form #add-day", function() {
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_day",
      success: function(d, t, x) {
        $(".days").last().after(d);
      }
    });
  });

  $(document).on("click", "#plan-form #add-attendee", function() {
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_attendee",
      success: function(d, t, x) {
        $(".attendees").last().after(d);
      }
    });
  });

  $(document).on("click", "#plan-form #add-objective", function() {
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_objective",
      success: function(d, t, x) {
        $(".objectives").last().after(d);
      }
    });
  });
  $(document).on("click", "#plan-form #add-agenda-item", function() {
    let m_id = $(this).attr("m-id");
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_agenda_item/" + m_id,
      success: function(d, t, x) {
        if($(".agenda__items").length) {
          $(".agenda_items").last().after(d);
        } else {
          $(".agenda__day").first().append(d);
        }
      }
    });
  });

});
*/
