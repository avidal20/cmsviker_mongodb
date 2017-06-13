<?php

return [

    'bootstrapMaterialDatePicker' => [
        'js' => [
          'adminbsb/plugins/momentjs/moment.js',
          'adminbsb/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
          ],
        'css' => 'adminbsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        'useJs' => "
          \$(document).ready(function(){

            \$('.field_fech').bootstrapMaterialDatePicker({
               weekStart : 0,
               time: false,
               format : 'DD-MM-YYYY',
               lang : '".config('app.locale')."'
             });

          });
        ",
    ],

    'autosize' => [
        'js' => 'adminbsb/plugins/autosize/autosize.min.js',
        'useJs' => "autosize(\$('#description'));",
    ],




    'NProgress' => [
      'css' => 'vendors/nprogress/nprogress.css',
      'js' => 'vendors/nprogress/nprogress.js',
    ],

    'iCheck' => [
      'css' => 'vendors/iCheck/skins/flat/green.css',
      'js' => 'vendors/iCheck/icheck.min.js',
    ],

    'bootstrap-wysiwyg' => [
      'css' => 'vendors/google-code-prettify/bin/prettify.min.css',
      'js' => [
        'vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
        'vendors/jquery.hotkeys/jquery.hotkeys.js',
        'vendors/google-code-prettify/src/prettify.js',
      ],
    ],

    'Switchery' => [
      'css' => 'vendors/switchery/dist/switchery.min.css',
      'js' => 'vendors/switchery/dist/switchery.min.js',
    ],

    'starrr' => [
      'css' => 'vendors/starrr/dist/starrr.css',
      'js' => 'vendors/starrr/dist/starrr.js',
    ],

    'Datatable' => [

      'css' => [
          'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
          'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
          'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
          'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
          'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css',
        ],

        'js' => [
          'vendors/datatables.net/js/jquery.dataTables.min.js',
          'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
          'vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
          'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
          'vendors/datatables.net-buttons/js/buttons.flash.min.js',
          'vendors/datatables.net-buttons/js/buttons.html5.min.js',
          'vendors/datatables.net-buttons/js/buttons.print.min.js',
          'vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
          'vendors/datatables.net-keytable/js/dataTables.keyTable.min.js',
          'vendors/datatables.net-responsive/js/dataTables.responsive.min.js',
          'vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',
          'vendors/datatables.net-scroller/js/datatables.scroller.min.js',
          'vendors/jszip/dist/jszip.min.js',
          'vendors/pdfmake/build/pdfmake.min.js',
          'vendors/pdfmake/build/vfs_fonts.js',
        ],

        'useJs' => '
        \$(document).ready(function() {

        var f = new Date();
        var fech = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();

        var handleDataTableButtons = function() {
          if (\$("#datatable-buttons").length) {
            \$("#datatable-buttons").DataTable({
              dom: "Blfrtip",
              buttons: [
                {
                  extend: "excel",
                  className: "btn-sm",
                  title: "Informaci\u00F3n_"+fech
                },
              ],
              responsive: true,
                language: {
                  "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        \$("#datatable").dataTable();

        \$("#datatable-keytable").DataTable({
          keys: true
        });

        \$("#datatable-responsive").DataTable();

        \$("#datatable-scroller").DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        \$("#datatable-fixed-header").DataTable({
          fixedHeader: true
        });

        var \$datatable = \$("#datatable-checkbox");

        \$datatable.dataTable({
          "order": [[ 1, "asc" ]],
          "columnDefs": [
            { orderable: false, targets: [0] }
          ]
        });
        \$datatable.on("draw.dt", function() {
          \$("input").iCheck({
            checkboxClass: "icheckbox_flat-green"
          });
        });

        TableManageButtons.init();
      });
        
        ',

    ],

    'jQuery-autocomplete' => [
      'js' => 'vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js'
    ],

    'jQuery-autocomplete' => [
      'js' => 'vendors/fastclick/lib/fastclick.js'
    ],

    'summernote' => [
      'css' => 'vendors/summernote/dist/summernote.css',
      'js' => 'vendors/summernote/dist/summernote.min.js',
    ]

];
