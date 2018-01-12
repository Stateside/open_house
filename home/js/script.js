$( document ).ready(function() {
    var setWinner = function(winner) {
        $.get( "http://34.203.61.130/restapi/v1/winner?win="+winner, function(success) {
            var obj = jQuery.parseJSON(JSON.stringify(success));
            var text = "Name: " + obj.name + "<br>Last Name: " + obj.last_name +  "<br>Phone: " + obj.phone;
            $( "#dataWinner"+winner).html( text );
      })
      .fail(function(err) {
          alert(JSON.stringify(err));
        console.log("API error! \n\n"+err);
      });
  }; 
  
  
  var resetWinner = function(winner) {
    $.get( "http://34.203.61.130/restapi/v1/delete_winner?win="+winner, function(success) {
        $( "#dataWinner"+winner).html( "" );
  })
  .fail(function(err) {
      alert(JSON.stringify(err));
    console.log("API error! \n\n"+err);
  });
}; 
    
    $( "#win3" ).click(function() {
        setWinner(3);
    });
    $( "#win2" ).click(function() {
        setWinner(2);
    });
    $( "#win1" ).click(function() {
        setWinner(1);
    });  
    
    $( "#resetWinner3" ).click(function() {
        resetWinner(3);
    });
    $( "#resetWinner2" ).click(function() {
        resetWinner(2);
    });
    $( "#resetWinner1" ).click(function() {
        resetWinner(1);
    });  

});