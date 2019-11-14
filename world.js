/*global $*/
/*golbal fetch*/
//console.log("wow");
$(document).ready(() => {
    
    
    $('#lookup').click(() => {
        let query = $('#country').val().trim();
        let url = "world.php";
        if (query) {
            query = '?country=' + query;
        }
        console.log("Query is " + query);
        
        fetch(url + query)
        .then(response => {
            return response.text();
        }).then(data => {
            $('#result').html(data);
        });
    })
});