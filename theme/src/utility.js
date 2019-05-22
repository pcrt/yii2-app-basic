function toggleSidebar(){
  $('.pcrt-sidebar').toggleClass('active');
}

$(document).ready(function () {
  if ( $(window).width() < 1280 ) {
      $('#sidebar').toggleClass('active');
  };

  $(window).resize(function () {
     if ( $(window).width() < 1280 ) {
         $('#sidebar').addClass( "active" );
     } else if ( $(window).width() > 1281 ){
         $('#sidebar').removeClass( "active" );
     }
    });
});

function infiniteScroll(_url){

$('.pcrt-wrapper-grid').hide();
$('.loader').show();
if(window.infScroll !== undefined){
    window.infScroll.destroy();
}
$('.pcrt-main-body').html('');
var elem = document.querySelector('.pcrt-main-body');
window.infScroll = new InfiniteScroll( elem, {
  path: function() {
      var page = this.pageIndex-1;
      return _url+page;
  },
  append: '.row-item',
  history: false,
});
window.infScroll.loadNextPage();
$('.loader').hide();
$('.pcrt-wrapper-grid').show();

}

  $(function () {
      $('[data-toggle="popover"]').popover()
  })
  $('.popover-dismiss').popover({
      trigger: 'focus'
  })


  /*$(document).ready(function() {
      var table = $("[id^=rfqtablerow]").DataTable( {
          scrollX: true,
          scrollCollapse: true,
          paging: false,
          searching: false,
          ordering: false,
          info: false,
          fixedColumns: {
              leftColumns: 4
          }
      } );
      console.log(table)
  } );*/

  $(document).ready(function() {


      /*$('#rfqtablerow2 tbody')
      .on( 'mouseenter', 'td', function () {
          var colIdx = table.cell(this).index().column;

          $( table.cells().nodes() ).removeClass( 'highlight' );
          $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
      } );*/

      $( "table.rfqtable.opent thead th" )
          .mouseenter(function() {
              $(this).addClass('highlight');
          })
          .mouseleave(function() {
              $(this).removeClass('highlight');
          });

  } );

function checkTermCondition(title){
  $.get('/suppliers/check-term-condition', function(data) {
    if(data.show_modal == true)
      showTermCondition(title);
  });
}

function showTermCondition(title){
    var jd = $.confirm({
      content:'url:/suppliers/show-term-condition',
      columnClass: 'medium',
      theme: 'bootstrap',
      title: title,
      draggable: false,
      animateFromElement: false,
      animation: 'top',
      useBootstrap: true,
      closeIcon: true,
      columnClass:'col-md-12 col-sm-12 col-xs-10 col-xs-offset-1',
      buttons: {
          CONTINUE: {
            btnClass: 'text-uppercase btn btn-success',
            action:function() {

                var form = "#term_and_condition";
                $.ajax({
                    method: 'POST',
                    cache: false,
                    url: '/suppliers/set-term-condition',
                    data: $(form).serialize(),
                    beforeSend: function( xhr ) {
                    },
                    statusCode: {
                        500: function() {
                        }
                    }
                }).done(function(data) {
                  // reload page
                  if(data.code == 200){
                    return jd.close();
                  }else{
                    $(form).yiiActiveForm('updateMessages', data, true);
                    return false;
                  }
                });
                return false;
            },
          }
      },
    });
  }

function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode

  //eccezione per il punto e per la virgola
  if (charCode == 44 || charCode == 46)
      return true;
  
  if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

  return true;
}
