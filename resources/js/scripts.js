document.addEventListener("DOMContentLoaded", function(){
  // Tabbing around
  onClick(".tab-bar .tab", function() {
    console.log("Click!");
    let clickedTab = this;
    let clickedTabIndex = clickedTab.getAttribute("tab-index");
    let clickedTabBar = this.closest(".tab-bar");
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
  onClick("#meetings-tab .tab", function() {
    document.querySelector("[name=meeting\\[tab\\]]").value = this.getAttribute("tab-index");
  });

  onClick("#next-steps-tab .tab", function() {
    document.querySelector("[name=next-step\\[tab\\]]").value = this.getAttribute("tab-index");
  });

  onClick(".tab-sort-filter__sort-toggle", function() {
    this.parentElement.querySelector(".tab-sort-filter__filters").classList.remove("active");
    this.parentElement.querySelector(".tab-sort-filter__sorts").classList.toggle("active");
  });

  onClick(".tab-sort-filter__filter-toggle", function() {
    this.parentElement.querySelector(".tab-sort-filter__sorts").classList.remove("active");
    this.parentElement.querySelector(".tab-sort-filter__filters").classList.toggle("active");
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

  onChange(
    "#plan-form input, #plan-form select, #plan-form textarea",
    function() {
      let m_id = document.querySelector("[name=id]").value;
      console.log(m_id);
      let d = toQueryString("#plan-form");
      console.log(d);
      console.log($("#plan-form").serialize());
      ajaxCall({
        method: "PUT",
        headers: {'Content-type': 'application/x-www-form-urlencoded'},
        url: "/plan/save/" + m_id,
        data: d,
      })
    });

  onClick("#plan-form #save-button", function() {
      let m_id = document.querySelector("[name=id]").value;
      console.log(m_id);
      let d = toQueryString("#plan-form");
      console.log(d);
      ajaxCall({
        method: "PUT",
        headers: {'Content-type': 'application/x-www-form-urlencoded'},
        url: "/plan/save/" + m_id,
        data: d,
      })
  });

  onClick("#plan-form #add-attendee", function() {
    document.querySelector(".attendees__col").innerHTML += document.getElementById("new-attendee").innerHTML;
  });

  onClick("#plan-form #add-guest", function() {
    document.querySelector(".guests__col").innerHTML += document.getElementById("new-guest").innerHTML;
  });

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
