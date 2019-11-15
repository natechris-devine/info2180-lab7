/*global $*/
/*golbal fetch*/
//console.log("wow");
$(document).ready(() => {
    
    function executeQuery(context='') {
        let query = $('#country').val().trim();
        let url = "world.php";
        if (query) {
            query = '?country=' + query + '&context=' + context;
        }
        //console.log("Query is " + query);
        
        fetch(url + query)
        .then(response => {
            return response.text();
        }).then(data => {
            $('#result').html(data);
        });
    }
    
    $('#lookup').click(executeQuery);
    $('#lookup-cities').click(() => {
        executeQuery('cities');
    })
});