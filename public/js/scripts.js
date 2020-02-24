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
    console.log($(this));
    $.ajax({
      method: 'GET',
      url: '/ajax/my_meetings',
      data: $("#mns-form").serialize(),
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
  $(document).on("change", "#mns-form .next-steps-ajax input", function () {
    console.log($(this));
    $.ajax({
      method: 'GET',
      url: '/ajax/my_next_steps',
      data: $("#mns-form").serialize(),
      success: function success(d, ts, xhr) {
        $(".next-steps-ajax .tab-body-bar").html($(d).find(".tab-body-bar").html());
      },
      error: function error(x, t, e) {
        $(".ajax").html(x);
        $(".ajax").append(t);
        $(".ajax").append(e);
      }
    });
  });
  $(document).on("change", "#run-form .meetings-ajax input", function () {
    console.log($(this));
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
});
