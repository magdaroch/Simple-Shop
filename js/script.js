$(function () {

        $('#deleteButton').on('click', '.toDel', function (event) {
        event.stopPropagation();

        var idToDel = [];
        idToDel.id =$(this).parent().find('tr');
        console.log(idToDel);
        

        $.ajax({
            url: 'app/order.php',
            type: 'DELETE',
            data: {id : idToDel.id},
            dataType: 'json',
            success: function (result) {
               console.log(result['statusToConfirm']);
            },
            error: function (err) {
                console.log('blad DELETE ');
                ;
            },
            complete: function () {
                console.log('complete DELETE');
            }
        });
});
});

