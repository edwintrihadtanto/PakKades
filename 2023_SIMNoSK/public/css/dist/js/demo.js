/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
//(function ($id_spt, $nomor_spt) {    
(function ($) {
    'use strict'

    var $sidebar   = $('.control-sidebar')
    var $container = $('<div />', {
      class: 'p-3 control-sidebar-content'
    })

    // var $a = $id_spt
    // var $b = $nomor_spt
    $sidebar.append($container)
    // var $balik = $('<div />', {'class': 'mr-1'}).append('<button class="btn" data-widget="control-sidebar" data-slide="true" style="color:#ffffff; margin-top:-25px; margin-left:-16px; "><i class="fas fa-arrow-right" ></i></button>')
    // $container.append($balik)

    // $container.append(
    //   '<h6 align="center">Daftar Laporan E-SPPD</h6><hr class="mb-2"/>'
    // )

    var $text_sm_body_checkbox = $('<input />', {
      type   : 'checkbox',
      value  :  $('body').addClass('text-sm'),
      //checked: true,
      'class': 'mr-1'
    }).on('click', function () {
      if ($(this).is(':checked')) {
        $('body').addClass('text-sm')
      } else {
        $('body').removeClass('text-sm')
      }
    })

    // var $text_sm_body_container = $('<div />', {'class': 'mr-1'}).append('<button class="btn btn-outline-warning btn-sm" onclick=""><i class="fas fa-list-alt" ></i> Lap. Rekap Data Pegawai</button><hr class="mb-2" style="background-color:#ffffff;"/>')
    // $container.append($text_sm_body_container)
    // var $text_sm_body_container = $('<div />', {'class': 'mr-1'}).append('<button class="btn btn-outline-primary btn-sm" ><i class="fas fa-list-alt" ></i> Lap. Rekap Data SPPD</button><hr class="mb-2" style="background-color:#ffffff;"/>')
    // $container.append($text_sm_body_container)
  }
)(jQuery)

