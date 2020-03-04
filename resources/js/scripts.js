/*
 *  These are function definitions yes.
 *  However they are only used for the dragging
 *  and dropping of agenda items, so they go in here
 */

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
    url: "/ajax/agenda/move_item/" + aiDragged + "/" + aiDropped,
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
  console.log("Over Prevented");
//let ai = e.target.closest(".agenda__item");
//ai.style.marginTop = "2rem";
}

function dragLeaveTest(e) {
  e.preventDefault();
  console.log("Leave Prevented", e.target);
//let ai = e.target.closest(".agenda__item");
//ai.style.marginTop = "0rem";
}


document.addEventListener("DOMContentLoaded", function(){
  // Tabbing around
  onClick(".tab-bar .tab", function(e) {
    let clickedTab = e.target;
    let clickedTabIndex = clickedTab.getAttribute("tab-index");
    let clickedTabBar = e.target.closest(".tab-bar");
    let clickedTabBarId = clickedTabBar.id;
    let otherTabs = clickedTabBar.querySelectorAll(".tab");
    let controllees = document.querySelectorAll("[controlled-by=\"" + clickedTabBarId + "\"]");

    otherTabs.forEach(function(tab) {
      tab.classList.remove("active");
    });
    clickedTab.classList.add("active");

    controllees.forEach(function(tabBodyBar) {
      tabBodyBar.querySelectorAll(".tab-body").forEach(function(tabBody) {
        console.log(tabBody);
        if (tabBody.getAttribute("tab-index") == clickedTabIndex) {
          tabBody.classList.add("active");
        } else {
          tabBody.classList.remove("active");
        }
      })
    })
  })

  // For meetings and next steps tab, keep a record of what tab's open
  onClick("#meetings-tab .tab", function(e) {
    document.querySelector("[name=meeting\\[tab\\]]").value = e.target.getAttribute("tab-index");
  });

  onClick("#next-steps-tab .tab", function() {
    document.querySelector("[name=next-step\\[tab\\]]").value = e.target.getAttribute("tab-index");
  });

  onClick(".tab-sort-filter__sort-toggle", function() {
    e.target.parentElement.querySelector(".tab-sort-filter__filters").classList.remove("active");
    e.target.parentElement.querySelector(".tab-sort-filter__sorts").classList.toggle("active");
  });

  onClick(".tab-sort-filter__filter-toggle", function() {
    e.target.parentElement.querySelector(".tab-sort-filter__sorts").classList.remove("active");
    e.target.parentElement.querySelector(".tab-sort-filter__filters").classList.toggle("active");
  });

  onChange("#mns-form .meetings-ajax", function() {
    console.log("/ajax/my_meetings?" + toQueryString("#mns-form"));
    ajaxReload({
      url: "/ajax/my_meetings?" + toQueryString("#mns-form"),
    }, ".mns-meeting-list")
  });

  onChange("#mns-form .next-steps-ajax", function() {
    console.log("/ajax/my_next_steps?" + toQueryString("#mns-form"));
    ajaxReload({
      url: "/ajax/my_next_steps?" + toQueryString("#mns-form"),
    }, ".mns-next-step-list")
  });

  onChange( "#plan-form input, #plan-form select, #plan-form textarea", function() {
    planSave();
  });

  onClick("#plan-form #add-attendee", function() {
    document.querySelector(".plan__attendees").innerHTML += document.getElementById("new-attendee").innerHTML;
  });

  onClick("#plan-form #add-guest", function() {
    document.querySelector(".plan__guests").innerHTML += document.getElementById("new-guest").innerHTML;
  });

  onClick("#plan-form #add-objective", function() {
    ajaxRequest({
      url: "/ajax/plan/add_objective",
      success: function(d) {
        console.log(d)
        document.querySelector(".plan__objectives").innerHTML += (d.response);
      }
    })
  })

  onClick("#plan-form #add-day", function() {
    ajaxRequest({
      url: "/ajax/plan/add_day",
      success: function(d) {
        console.log(d)
        document.querySelector(".plan__days").innerHTML += (d.response);
        planSave();
      }
    })
  })

  onClick("#plan-form #add-agenda-item", function(e) {
    let day_id = e.target.getAttribute("d_id");
    let item_type = e.target.getAttribute("i_type");
    console.log(day_id, item_type);
    ajaxRequest({
      method: 'POST',
      data: "_token=" + document.querySelector("[name=_token]").value,
      headers: {'Content-type': 'application/x-www-form-urlencoded'},
      url: "/ajax/agenda/add_item/" + day_id + "/" + item_type,
      success: function(d) {
        console.log(d)
        document.querySelector(".agenda").innerHTML = d.response;
      }
    })
  })

  onClick("#plan-form #delete-agenda-item", function(e) {
    let item_id = e.target.getAttribute("ai_id");
    ajaxRequest({
      method: 'DELETE',
      url: "/ajax/agenda/delete_item/" + item_id,
      headers: {'Content-type': 'application/x-www-form-urlencoded'},
      data: "_token=" + document.querySelector("[name=_token]").value,
      success: function(d) {
        console.log(d)
        document.querySelector(".agenda").innerHTML = d.response;
      }
    })
  })



  // Handler when the DOM is fully loaded
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
