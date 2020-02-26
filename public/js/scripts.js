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
      d.innerHTML = x.responseText;
      console.log(x);
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

$(document).ready(function () {
  // Super simple tabbing
  $(document).on("click", ".tab-bar .tab", function (e) {
    var bar = $(this).parents(".tab-bar"); // Get the tab bar

    var c = $(bar).attr("id"); // Get its ID

    var i = $(this).attr("tab-index"); // Get the index of the selected tab

    var controllees = $("[controlled-by=" + c + "]"); // Get the tab bodies controlled by this bar
    // Remove all instances of the class "active" and reapply only to the relevant tab body

    $(this).siblings().removeClass("active");
    $(this).addClass("active");
    $(controllees).find(".tab-body").removeClass("active");
    $(controllees).find(".tab-body[tab-index=" + i + "]").addClass("active");
  }); // Sort and filter tab dropdowns

  $(document).on("click", ".tab-sort-filter__sort-toggle", function () {
    $(this).siblings(".tab-sort-filter__filters").removeClass("active");
    $(this).siblings(".tab-sort-filter__sorts").toggleClass("active");
  });
  $(document).on("click", ".tab-sort-filter__filter-toggle", function () {
    $(this).siblings(".tab-sort-filter__sorts").removeClass("active");
    $(this).siblings(".tab-sort-filter__filters").toggleClass("active");
  });
  $(document).on("change", "#mns-form .meetings-ajax input", function () {
    //console.log($(this));
    ajaxReload({
      url: "/ajax/my_meetings?" + $("#mns-form").serialize()
    }, ".mns-meeting-list");
  });
  $(document).on("change", "#mns-form .next-steps-ajax input", function () {
    //console.log($(this));
    ajaxReload({
      url: "/ajax/my_next_steps?" + $("#mns-form").serialize()
    }, ".mns-next-step-list");
  });
  $(document).on("change", "#run-form .meetings-ajax input", function () {
    //console.log($(this));
    $.ajax({
      method: 'GET',
      url: '/ajax/my_meetings_run',
      data: $("#run-form").serialize(),
      success: function success(d, ts, xhr) {
        $(".meetings-ajax .tab-body-bar").html($(d).find(".tab-body-bar").html());
      },
      error: function error(x, t, e) {
        $(".ajax").html(x);
        $(".ajax").append(t);
        $(".ajax").append(e);
      }
    });
  });
  $(document).on("click", "#meetings-tab .tab", function () {
    $("[name=meeting\\[tab\\]]").val($(this).attr("tab-index"));
  });
  $(document).on("click", "#next_steps-tab .tab", function () {
    $("[name=next_step\\[tab\\]]").val($(this).attr("tab-index"));
  });
  $(document).on("change", "#plan-form input, #plan-form select", function (e) {
    e.preventDefault();
    var m_id = $("[name=id]").val();
    console.log(m_id);
    $.ajax({
      url: "/plan/details/" + m_id,
      data: $("#plan-form").serialize(),
      method: "PUT",
      success: function success(d, x, t) {
        console.log("Success");
        $(".flex-fill").html(d);
      }
    });
  });
  $(document).on("click", "#plan-form #add-day", function () {
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_day",
      success: function success(d, t, x) {
        $(".days").last().after(d);
      }
    });
  });
  $(document).on("click", "#plan-form #add-attendee", function () {
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_attendee",
      success: function success(d, t, x) {
        $(".attendees").last().after(d);
      }
    });
  });
  $(document).on("click", "#plan-form #add-objective", function () {
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_objective",
      success: function success(d, t, x) {
        $(".objectives").last().after(d);
      }
    });
  });
  $(document).on("click", "#plan-form #add-agenda-item", function () {
    var m_id = $(this).attr("m-id");
    $.ajax({
      method: "GET",
      url: "/ajax/plan_add_agenda_item/" + m_id,
      success: function success(d, t, x) {
        if ($(".agenda__items").length) {
          $(".agenda_items").last().after(d);
        } else {
          $(".agenda__day").first().append(d);
        }
      }
    });
  });
});
