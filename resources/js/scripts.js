// Super simple tabbing
$(".tab-bar").on("click", ".tab", function(e) {
  let bar = $(this).parents(".tab-bar");            // Get the tab bar
  let c = $(bar).attr("id");                        // Get its ID
  let i = $(this).attr("tab-index");                // Get the index of the selected tab
  let controllees = $("[controlled-by=" + c + "]"); // Get the tab bodies controlled by this bar

  // Remove all instances of the class "active" and reapply only to the relevant tab body
  $(this).siblings().removeClass("active");
  $(this).addClass("active");
  $(controllees).find(".tab-body").removeClass("active");
  $(controllees).find(".tab-body[tab-index=" + i + "]").addClass("active");
})

$(document).ready(function() {
  console.log("Hello world!");
})
