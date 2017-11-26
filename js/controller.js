function startMining() {
    jQuery.ajax({
        type: "POST",
        url: "../lib/TwitterMining.php",
        data:{
            action: 'minning'
        },
        success: function( data )
        {
			alert("sucesso");
            
        }   
    });
}