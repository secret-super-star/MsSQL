$(document).ready(function (){
  var user_name = $('#user_list').val();

  $('#user_list').change(function (){
    user_name = $(this).val();
    get_summary();
  })

  function get_summary(){
    var send_data = {
      username : user_name
    }
    $.ajax({
        url: '/get_summary.php',
        type: 'post',
        data: send_data,
        dataType: 'json',
        cache: false,
        success: function (data, textStatus, jQxhr) {

            console.log(data);

            $('.bets_done').val(data['count']);
            $('.unsettled').val(data['unsettled']);
            $('.settled').val(data['settled']);
            $('.instake').val(parseFloat(data['resume']['Stake']).toFixed(2));
            $('.profit').val((parseFloat(data['resume']['Profit']) - parseFloat(data['resume']['Stake'])).toFixed(2));
            $('.roi').val((parseFloat(data['resume']['Profit']) / parseFloat(data['resume']['Stake']) * 100).toFixed(2)+"%");

        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    }).done(function () { });
  }

  get_summary();
})
