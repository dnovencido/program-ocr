$(document).ready(function(){

	$('#search-transaction').keyup(function(){
        var searchField = $('#search-transaction').val();
        if(searchField != "") {
            $('#result').html('');
            $('#state').val('');
            $('#refnum').val('');
            $('#amount').val('')
          
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "search.php?refnum=" + searchField,
                success: function(data) {
                    var output = '';
                    var listGroup = $('#result');
                    
                    if(data.length > 0) {
                        data.forEach(function(item) {
                            output += '<li class="list-group-item item-list" refnum="'+item.refnum+'" amount="'+item.amount+'">'+ item.refnum + '</li>';
                        });
                    } else {
                        output += '<li class="list-group-item">No results found.</li>';
                    }
                    listGroup.html(output);
                    
                    var item = $('.item-list');
                    
                    item.click(function() {
                        $('#refnum').val($(this).attr("refnum"));
                        $('#amount').val($(this).attr("amount"));
                        
                    })
                }
            });
        }
    });

    //Delete transactions
    var btnDeleteTransaction = $('.btn-delete-transaction');

    if(btnDeleteTransaction.length > 0) {
        btnDeleteTransaction.each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                var result = confirm("Do you want to delete this transaction?");
                if(result) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "delete-transaction.php?tranID=" + $(this).attr("data-id"),
                        success: function(data) {
                            if(data.deleted == true) {
                                window.location.href = "transactions.php";
                            } else {
                                alert("There was an error deleting the transaction. Please try again later.")
                            }
                        }
                    });
                }
            });
        });
    }    
});