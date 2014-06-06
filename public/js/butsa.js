$(document).ready(function(){  
    
  $('#b_send_id').click(function(){
      var player_id = $('#b_player_id').val();
      $.post('/butsa/upl/'+player_id, function(data){
          $('#b_player_info').html(data);
      });
  });
  
  $('#b_team_update').click(function(){      
      $.post('/butsa/update', function(data){
          $('#team').html(data);
      });
  });
  
  $('#b_calc_skill').click(function(){      
      $.post('/butsa/calcSkill', function(data){
          $('#resultSkill').html(data);
      });
  });
  
  $('a#calc_mass1').click(function(){
      var player_id = $('#id_player').val();
      var start_tren = $('#start_tren').val();
      var num_tren = $('#num_tren').val();
      $.post('/butsa/calcMas/'+player_id,{start_tren:start_tren, num_tren:num_tren}, function(data){
          $('#resultMas').html(data);
      });
  });
  $('a#calc_team').click(function(){   
      var start_tren = $('#start_tren_team').val();
      var num_tren = $('#num_tren_team').val();
      $.post('/butsa/calcTeam/',{start_tren:start_tren, num_tren:num_tren}, function(data){
          $('#resultTeam').html(data);
      });
  });
});

