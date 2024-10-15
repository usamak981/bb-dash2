/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/assets/js/scripts.js ***!
  \****************************************/
(function (window, undefined) {
  'use strict';
  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

  if (jQuery('meta[name="csrf-token"]').length) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
      }
    });
  }

  jQuery(document.body).on("click", ".del-btn", function () {
    var that = $(this);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-outline-danger ms-1'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.isConfirmed) {
        if (that.hasClass('imageDelBtn')) {
          $(".imageDelForm").submit();
        } else {
          that.next('form').submit();
        }
      }
    });
  });
  $(document.body).on("click", ".image-upload-div img", function () {
    $(this).next('input[type="file"]').click();
  });
  $(document.body).on("change", ".image-upload-div input[type='file']", function (e) {
    var input = e.target;

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(input).prev('img').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  });

  function initDatePicker() {
    var element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
    element = element !== false ? element : ".flatpickr-range";

    if ($(element).length) {
      $(".flatpickr-range").daterangepicker({
        "autoApply": true,
        locale: {
          format: 'MM.YYYY'
        }
      }, function (start, end, label) {
        console.log('New date range selected: ' + start.format('MM.YYYY') + ' to ' + end.format('MM.YYYY') + ' (predefined range: ' + label + ')');
      });
    }
  }

  initDatePicker();

  function focusOnLastProjekt() {
    var lastProjekt = $("#projekts-div .card:last-child select:first");

    if (lastProjekt.length) {
      $('html, body').animate({
        scrollTop: lastProjekt.offset().top
      }, 1000);
    }
  }

  var formTouched = false;
  $("#ajaxForm").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formTouched = false;
    $.ajax({
      url: $(this).attr('action'),
      type: "post",
      dataType: "json",
      success: function success(e) {
        if (e['redirect']) {
          window.location.href = e.redirect;
        } else {
          window.location.reload();
        }
      },
      error: function error(e) {
        var resp = $.parseJSON(e.responseText);

        if (e.status === 422) {
          var errors = resp.errors;
          $.each(errors, function (x, y) {
            if (y != null && y !== "") {
              toastr.error(y);
            }
          });
        } else if (resp.message) {
          toastr.error(resp.message);
        } else {
          toastr.error("Something went wrong. Please try again.");
        }
      },
      // Form data
      data: formData,
      //Options to tell jQuery not to process data or worry about content-type.
      cache: false,
      contentType: false,
      processData: false
    });
  });
  $("#addProject").click(function () {
    var project = $($("#newProjekt").html());
    var currentTimeStamp = +new Date();
    project.find("input, select, textarea").each(function () {
      var name = $(this).attr("name") + "[" + currentTimeStamp + "]";
      var type = $(this).attr("type");

      if (type === 'file') {
        name += "[]";
      }

      $(this).attr('name', name);
    });
    $("#projekts-div").append(project);
    initDatePicker("input[name='period[" + currentTimeStamp + "]']");
    focusOnLastProjekt();
  });
  $(document).on("click", ".delProject", function () {
    $(this).closest('.card').remove();
  });
  $(function () {
    $('.search-img').on('click', function () {
      $('.imagepreview').attr('src', $(this).attr('src'));
      $('.imageViewBtn').attr('href', $(this).attr('src'));
      $('.imageID').text($(this).attr('data-id'));
      $('.imageDescription').val($(this).attr('data-description'));
      $('.imageCopyright').val($(this).attr('data-copyright'));
      $('.imageObjketType').val($(this).attr('data-objekt-type')).trigger("change");
      $('.imageProjketType').val($(this).attr('data-projekt-type')).trigger("change");
      $('.imageForm').attr("action", $('.imageForm').attr("data-action") + "/" + $(this).attr('data-id'));
      $('.imageDelForm').attr("action", $('.imageForm').attr("data-action") + "/" + $(this).attr('data-id'));
      $('#imagemodal').modal('show');
    });

    $(".close").onclick = function () {
      $('#imagemodal').modal('hide');
    };
  });
  $(".select2").each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });

  if ($('.form-unload-check').length) {
    $(document).on('change', '.form-unload-check input,.form-unload-check textarea, .form-unload-check select', function () {
      formTouched = true; //console.log("input changed")
    });
    $(document).on('click', '.form-unload-check #addProject, .form-unload-check delProject', function () {
      formTouched = true; //console.log("button clicked")
    });
    $(document).on('click', 'button[type="submit"], #update-export', function () {
      formTouched = false;
    });

    window.onbeforeunload = function () {
      //console.log("before unload event", formTouched)
      if (formTouched && $(document.activeElement).attr('type') !== 'submit') {
        return "Please save your updates to the project";
      }
    };
  }

  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
})(window);
/******/ })()
;