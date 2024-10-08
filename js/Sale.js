$(document).ready(function() {
    let funcion = 'searchOrder';

    let dataTable = $('#tableSalee').DataTable({
        ajax: {
            url: "../controller/SaleController.php",
            method: "POST",
            data: { funcion: funcion },
            dataSrc: 'data', // Adjusted to 'data' since the response JSON has a 'data' key
            error: function(xhr, error, thrown) {
                console.error("Error in AJAX request:", xhr, error, thrown);
            }
        },
        columns: [
            { data: "id_sale" },
            { data: "client" },
            { data: "date_sale" },
            { data: "total" },
            { data: "seller" },
            {
                data: null,
                defaultContent: `<button class="watchSaleBaby btn btn-success" type="button" data-toggle="modal" data-target="#watchSale">
                    <i class="fas fa-search"></i></button>`
            }
        ]
    });

    $('#tableSalee tbody').on('click', '.watchSaleBaby', function() {
        let row = $(this).closest('tr');

        let data = dataTable.row(row).data();
        let id=data.id_sale;

        funcion="watch"
        //console.log("Selected row data:", data); // Log selected row data

        if (data) {
            $('#codSale').text(data.id_sale);
            $('#clientSale').text(data.client);
            $('#dateSale').text(data.date_sale);
            $('#totalSale').text(data.total);
            $('#sellerSale').text(data.seller);
            $('#total').text(data.total);
            $.post('../controller/SaleProductController.php',{funcion,id},(response)=>{
    console.log(response)
                let registers = JSON.parse(response)
                let template=""
                $('#resgiterSale').html(template)
                registers.forEach(register=>{
                    template+=`
                    <tr>
                        <td>${register.quantity}</td>
                         <td>${register.price}</td>
                          <td>${register.productname}</td>
                           <td>${register.concentration}</td>
                            <td>${register.laboratory}</td>
                            <td>${register.presentacion}</td>
                            <td>${register.tipo}</td>
                            <td>${register.subtotal}</td>
                    </tr>
                    
                    `
                    $('#resgiterSale').html(template)
                })

            })
        } else {
            console.error("No data found for selected row.");
        }
    });
});
