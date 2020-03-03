function dragTest(e) {
  //if(e.target.matches(".agenda__item")){
  let ai = e.target.closest(".agenda__item");
  console.log(ai);
  e.dataTransfer.setData("text", ai.id);
  //}
}
function dropTest(e) {
  e.preventDefault();
  console.log("Dropped");
  let aiDragged = e.dataTransfer.getData("text");
  let aiDropped = e.target.closest(".agenda__item").id;
  console.log(aiDragged, aiDropped);
  console.log(e);
  ajaxRequest({
    method: 'PUT',
    url: "/ajax/plan_move_agenda_item/" + aiDragged + "/" + aiDropped,
    headers: {'Content-type': 'application/x-www-form-urlencoded'},
    data: "_token=" + document.querySelector("[name=_token]").value,
    success: function(d) {
      //console.log(d)
      document.querySelector(".agenda").innerHTML = d.response;
    }
  })
}

function dragOverTest(e) {
  e.preventDefault();
  console.log("Prevented");
}

function ajaxReload(obj, selector) {
  let method = obj.method ? obj.method : 'GET';
  let url = obj.url;
  let async = obj.async ? obj.async : true;
  let user = obj.user ? obj.user : null;
  let password = obj.password ? obj.password : null;
  let x = new XMLHttpRequest();
  x.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      let d = document.createElement("div");
      d.innerHTML = x.responseText;
      //console.log(x);
      document.querySelector(selector).innerHTML = d.querySelector(selector).innerHTML;
      return true
    } else if (this.status != 200) {
      //console.log(this.responseText);
      return false;
    }
  }
  x.open(method, url, async, user, password);
  if(method == 'POST') {
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
  let method = obj.method ? obj.method : 'GET';
  let url = obj.url;
  let async = obj.async ? obj.async : true;
  let user = obj.user ? obj.user : null;
  let password = obj.password ? obj.password : null;
  let headers = obj.headers ? obj.headers : {};
  let before = obj.before ? obj.before : returnNull;
  let success = obj.success ? obj.success : returnNull;
  let failure = obj.failure ? obj.failure : returnNull;
  let complete = obj.complete ? obj.complete : returnNull;
  let x = new XMLHttpRequest();
  x.onreadystatechange = function() {
    if(this.readyState == 4) {
      before(this);
      console.log(this.status);
      if(this.status == 200) {
        success(this);
      } else {
        failure(this);
      }
      complete(this);
    }
  }
  x.open(method, url, async, user, password);
  for (let type in headers) {
    x.setRequestHeader(type, headers[type]);
  }
  x.send(obj.data);
  return null;
}

function onClick(sel, fn) {
  document.addEventListener("click", function(e) {
    if(e.target.matches(sel)) {
      fn(e);
    }
  })
}

function onChange(sel, fn) {
  document.addEventListener("change", function(e) {
    if(e.target.matches(sel)) {
      fn();
    }
  })
}

function toQueryString(sel) {
  let qs = [];
  qs[0] = sel + " input:not([disabled]):not([type=radio])";
  qs[1] = sel + " input[type=radio]:not([disabled]):checked";
  qs[2] = sel + " textarea:not([disabled])";

  qs = qs.join();
  let queryString = "";
  let qr = document.querySelectorAll(qs);
  qr.forEach(function(i) {
    queryString += "&" + i.name + "=" + i.value;
  })

  let selects = document.querySelectorAll(sel + " select:not([disabled])");
  selects.forEach(function(i) {
    queryString += "&" + i.name + "=" + i.querySelector("option:not([disabled]):checked").value;
  })

  //console.log(queryString);
  return encodeURI(queryString);
}

function planSave() {
  let m_id = document.querySelector("[name=id]").value;
  let d = toQueryString("#plan-form");
  ajaxRequest({
    method: "PUT",
    headers: {
      'Content-type': 'application/x-www-form-urlencoded',
      'Accept': 'application/json'
    },
    url: "/plan/save/" + m_id,
    data: d,
    before: function() {
      document.querySelector(".plan__success").innerHTML = "";
      document.querySelector(".plan__errors").innerHTML = "";
    },
    success: function() {
      document.querySelector(".plan__success").textContent = "Meeting saved successfully";
    },
    failure: function(x) {
      let errors = JSON.parse(x.responseText).errors
      let ul = document.createElement("ul");
      for(let name in errors) {
        let li = document.createElement("li");
        li.textContent = name + ": " + errors[name];
        ul.append(li);
      }
      document.querySelector(".plan__errors").append(ul);
    },
  })
}
