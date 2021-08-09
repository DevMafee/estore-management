(function($) {
    "use strict";

  /**** List And Grid System *****/
  $(".shop_product_style li").click(function() {
    $(".shop_product_style li.selected").removeClass("selected");
    $(this).addClass("selected");
  });

  $("#list").click(function(event) {
    event.preventDefault();
    $("#products .item").addClass("list-group-item");
  });
  $("#grid").click(function(event) {
    event.preventDefault();
    $("#products .item").removeClass("list-group-item");
    $("#products .item").addClass("grid-group-item");
  });

 /*** FilterSlider ***/
 function filterSlider() {
  var el = $(".ps-slider");
  var min = el.siblings().find(".ps-slider__min");
  var max = el.siblings().find(".ps-slider__max");
  var defaultMinValue = el.data("default-min");
  var defaultMaxValue = el.data("default-max");
  var maxValue = el.data("max");
  var step = el.data("step");
  if (el.length > 0) {
    el.slider({
      min: 0,
      max: maxValue,
      step: step,
      range: true,
      values: [defaultMinValue, defaultMaxValue],
      slide: function(event, ui) {
        var values = ui.values;
        min.text("$" + values[0]);
        max.text("$" + values[1]);
      }
    });
    var values = el.slider("option", "values");
    min.text("$" + values[0]);
    max.text("$" + values[1]);
  } else {
    // return false;
  }
}
$(function() {
  filterSlider();
});

  
  })(jQuery);
  