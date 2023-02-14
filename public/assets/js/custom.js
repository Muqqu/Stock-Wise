$(document).ready(function () {
  var sidebarWidth = $(".sidebar").width();

  if (window.innerWidth >= 992) {
    $(".content").css("margin-left", sidebarWidth + 60);
  }
  if (window.innerWidth <= 992) {
    $(".nav-tabs .nav-link").on("click", function () {
      $(".sidebar").removeClass("active");
      $(".main-content").removeClass("active");
    });
    $("#sidebar-toggler").click(function () {
      setTimeout(() => {
        $("#sidebar").toggleClass("active");
        $(".main-content").toggleClass("active");
  
      }, 100);
    });

    $(document).click(function (event) {
      if (!$(event.target).closest(".sidebar").length) {
        $(".sidebar").removeClass("active");
        $(".main-content").removeClass("active");
      }
    });
  }

  // custom select box start

  $.fn.RevSelectBox = function () {
    this.each(function () {
      var $this = $(this),
        numberOfOptions = $(this).children("option").length;

      $this.addClass("select-hidden");

      if (!$this.parent().hasClass("rev-select")) {
        $this.wrap('<div class="rev-select"></div>');
      }
      $this.closest(".rev-select").find(".select-styled").remove();
      $this.closest(".rev-select").find(".select-options").remove();

      $this.after('<div class="select-styled"></div>');

      var $styledSelect = $this.next("div.select-styled");
      if ($this.find("option:selected")) {
        $styledSelect.text($this.find("option:selected").text());
      } else {
        $styledSelect.text($this.children("option").eq(0).text());
      }

      var $list = $("<ul />", {
        class: "select-options",
      }).insertAfter($styledSelect);

      for (var i = 0; i < numberOfOptions; i++) {
        $("<li />", {
          text: $this.children("option").eq(i).text(),
          rel: $this.children("option").eq(i).val(),
        }).appendTo($list);
      }

      var $listItems = $list.children("li");

      $styledSelect.click(function (e) {
        e.stopPropagation();
        $("div.select-styled.active")
          .not(this)
          .each(function () {
            $(this).removeClass("active").next("ul.select-options").hide();
          });
        $(this).toggleClass("active").next("ul.select-options").toggle();
      });

      $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass("active");
        $this.val($(this).attr("rel")).trigger("change");
        $list.hide();
        //console.log($this.val());
      });

      $this.change(function (e) {
        // e.stopPropagation();
        $styledSelect.text($this.find("option:selected").text());
      });

      $(document).click(function () {
        $styledSelect.removeClass("active");
        $list.hide();
      });
    });
  };
  $("select").RevSelectBox();
  // custom select box end

  // custom form input file preview start
  $(".reset-input-btn").on("click", function () {
    $(this).addClass("d-none");
    $(this).parent().find("input").value = "";
    $(this).parent().find("label").removeClass("custom-label-sm");
    $("#categoryResults").html("");
    $("#subCategoryResults").html("");
    $("#productResults").html("");
  });
  $("#categoryInput").change(function (event) {
    var categoryResults = $("#categoryResults");
    $(categoryResults).html("");
    $(categoryResults).removeClass("single-post");
    if ($(this).get(0).files.length == 1) {
      $(categoryResults).addClass("single-post");
      for (var i = 0; i < $(this).get(0).files.length; ++i) {
        var fileItem =
          "<img src=" + URL.createObjectURL(event.target.files[i]) + ">";
        $(categoryResults).append(fileItem);
      }
    }
    if ($(this).val()) {
      $(this).parent().find("label").addClass("custom-label-sm");
      $(this).parent().find(".btn").removeClass("d-none");
    } else {
      $(this).parent().find("label").removeClass("custom-label-sm");
      $(this).parent().find(".btn").addClass("d-none");
      $(this).get(0).reset();
      $("#categoryInput").get(0).reset();
    }
  });
  // custom form input file preview end


  // $('[data-image-lightbox]').imageLightbox();


});

const amountCtx = document.getElementById('totalAmount');
const withdrawCtx = document.getElementById('withdraw');
const profitCtx = document.getElementById('profit');

// Initialize the data
var dailyData = [120, 94, 102, 85, 110, 93, 98, 112, 99, 105, 120, 95, 110, 103, 92, 105, 98, 115, 120, 104, 107, 112, 90, 100, 115, 122, 110, 98, 105, 112, 118];
var weeklyData = [671, 750, 679, 782, 875];
var monthlyData = [2957, 3025, 3200, 2875];

// Initialize the labels
var dailyLabels = ['Sat', 'Sun', 'Mon', 'Tue'];
var weeklyLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
var monthlyLabels = ['January', 'February', 'March', 'April'];

var myChart = new Chart(amountCtx, {
  type: 'line',
  data: {
    labels: dailyLabels,
    datasets: [
      {
        label: 'Daily',
        data: dailyData,
        backgroundColor: '#E4C9FF',
        borderColor: '#E4C9FF',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      },
      {
        label: 'Weekly',
        data: weeklyData,
        backgroundColor: '#b2edd3',
        borderColor: '#b2edd3',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      },
      {
        label: 'Monthly',
        data: monthlyData,
        backgroundColor: '#edb2b2',
        borderColor: '#edb2b2',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      }
    ]
  },
  options: {
    scales: {
      xAxes: [{
        ticks: {
          autoSkip: false, // prevent automatic skipping of labels
          callback: function (value, index, values) {
            // Use the correct label array depending on the chart zoom level
            if (dailyLabels.length > 30) {
              return value; // return the full date for daily data with more than 30 days
            } else if (dailyLabels.length > 7) {
              return 'Week ' + (index % 4 + 1); // return week labels for daily data with 8 to 30 days
            } else {
              return monthlyLabels[index]; // return monthly labels for daily data with less than 8 days
            }
          }
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});

var myChart = new Chart(withdrawCtx, {
  type: 'line',
  data: {
    labels: dailyLabels,
    datasets: [
      {
        label: 'Daily',
        data: dailyData,
        backgroundColor: '#E4C9FF',
        borderColor: '#E4C9FF',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      },
      {
        label: 'Weekly',
        data: weeklyData,
        backgroundColor: '#b2edd3',
        borderColor: '#b2edd3',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      },
      {
        label: 'Monthly',
        data: monthlyData,
        backgroundColor: '#edb2b2',
        borderColor: '#edb2b2',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      }
    ]
  },
  options: {
    scales: {
      xAxes: [{
        ticks: {
          autoSkip: false, // prevent automatic skipping of labels
          callback: function (value, index, values) {
            // Use the correct label array depending on the chart zoom level
            if (dailyLabels.length > 30) {
              return value; // return the full date for daily data with more than 30 days
            } else if (dailyLabels.length > 7) {
              return 'Week ' + (index % 4 + 1); // return week labels for daily data with 8 to 30 days
            } else {
              return monthlyLabels[index]; // return monthly labels for daily data with less than 8 days
            }
          }
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});

var myChart = new Chart(profitCtx, {
  type: 'line',
  data: {
    labels: dailyLabels,
    datasets: [
      {
        label: 'Daily',
        data: dailyData,
        backgroundColor: '#E4C9FF',
        borderColor: '#E4C9FF',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      },
      {
        label: 'Weekly',
        data: weeklyData,
        backgroundColor: '#b2edd3',
        borderColor: '#b2edd3',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      },
      {
        label: 'Monthly',
        data: monthlyData,
        backgroundColor: '#edb2b2',
        borderColor: '#edb2b2',
        borderWidth: 4,
        lineTension: 0.5, // set the line tension to control the curve
        fill: false, // disable the fill to show only the line
        cubicInterpolationMode: 'monotone', // set the interpolation mode to monotone
      }
    ]
  },
  options: {
    scales: {
      xAxes: [{
        ticks: {
          autoSkip: false, // prevent automatic skipping of labels
          callback: function (value, index, values) {
            // Use the correct label array depending on the chart zoom level
            if (dailyLabels.length > 30) {
              return value; // return the full date for daily data with more than 30 days
            } else if (dailyLabels.length > 7) {
              return 'Week ' + (index % 4 + 1); // return week labels for daily data with 8 to 30 days
            } else {
              return monthlyLabels[index]; // return monthly labels for daily data with less than 8 days
            }
          }
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
