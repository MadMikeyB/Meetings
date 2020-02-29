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
      console.log(this.responseText);
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

function ajaxCall(obj) {
  let method = obj.method ? obj.method : 'GET';
  let url = obj.url;
  let async = obj.async ? obj.async : true;
  let user = obj.user ? obj.user : null;
  let password = obj.password ? obj.password : null;
  let headers = obj.headers ? obj.headers : {};
  let x = new XMLHttpRequest();
  x.onreadystatechange = function() {
    if(this.readyState == 4) {
      if(this.status == 200) {
        return x
      } else {
        console.error(this);
      }
    }
  }
  console.log(headers);
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
      fn();
    }
  })
}

function onChange(sel, fn) {
  document.addEventListener("change", function(e) {
    if(e.target.matches(sel)) {
      fn();
    }
  })
  /*
  document.querySelectorAll(sel).forEach(function(el) {
    el.addEventListener("change", fn)
  })
  */
}

function toQueryString(sel) {
  let qs = [];
  qs[0] = sel + " input:not([disabled]):not([type=radio])";
  qs[1] = sel + " input[type=radio]:not([disabled]):checked";
  qs[2] = sel + " textarea:not([disabled])";

  qs = qs.join();
  let queryString = "";
  let qr = document.querySelectorAll(qs);
  console.log(qr);
  qr.forEach(function(i) {
    console.log(i.name, encodeURI(i.name), i.value, encodeURI(i.value))
    if(i.value) {
      queryString += "&" + i.name + "=" + i.value;
    }
  })

  let selects = document.querySelectorAll(sel + " select:not([disabled])");
  selects.forEach(function(i) {
    console.log(i.name, encodeURI(i.name), i.value, encodeURI(i.value))
    queryString += "&" + i.name + "=" + i.querySelector("option:not([disabled]):checked").value;
  })

  return encodeURI(queryString);
}

