$(document).ready(function (){
    $('#shoppingCart').show()
    searchProduct()
    showRiskyLot()
    function searchProduct(queryData){
        funcion = 'search'
        $.post('../controller/ProductController.php',{queryData,funcion},(response)=>{

            const products = JSON.parse(response)
            let template=''
            products.forEach(product=> {
                template+=`<div prodId="${product.id}" prodStock="${product.stock}"  prodName="${product.name}" prodPrice="${product.price}" prodConcentration="${product.concentration}"
            prodExtra="${product.extra}" prodLaboratory="${product.id_laboratory}" prodType="${product.id_type}" prodPresentation="${product.id_presentation}" prodAvatar="${product.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                <i class="fas fa-lg fa-cubes mr-1"></i>
                  ${product.stock}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                    <h2 class="lead"><b>Codigo: ${product.id}</b></h2>
                      <h2 class="lead"><b>${product.name}</b></h2>
                     <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${product.price}</b></h4>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${product.concentration}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Extra: ${product.extra}</li>
                         <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${product.laboratory}</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${product.type}</li>
                           <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion: ${product.presentation}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${product.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
               
                   
                     <button class="addCart lot btn btn-sm btn-primary">
                      <i class="fas fa-plus-square mr-2"></i>Agregar al carrito
                      </button>
                   
                  </div>
                </div>
              </div>
            </div>
            `

            })
            $('#products').html(template)


        })
    }

    $(document).on('keyup','#searchProduct',function(){
        let value = $(this).val()
        if(value!=""){
            searchProduct(value)
        }else{
            searchProduct()
        }
    })

    function showRiskyLot(){
        funcion='search'
        $.post('../controller/LotController.php',{funcion},(response)=>{
            const lots = JSON.parse(response)
            let template='';
            lots.forEach(lot=>{
                if(lot.state=='warning'){
                    template+=`
                <tr class="table-warning">
                <td>${lot.id}</td>
                <td>${lot.name}</td>
                <td>${lot.stock}</td>
                <td>${lot.laboratory}</td>
                <td>${lot.presentation}</td>
                <td>${lot.supplier}</td>
                 <td>${lot.months}</td>
                <td>${lot.days}</td>
                </tr>
                `
                }if(lot.state=='danger'){
                    template+=`
                <tr class="table-danger">
                <td>${lot.id}</td>
                <td>${lot.name}</td>
                <td>${lot.stock}</td>
                <td>${lot.laboratory}</td>
                <td>${lot.presentation}</td>
                <td>${lot.supplier}</td>
                 <td>${lot.months}</td>
                <td>${lot.days}</td>
                </tr>
                `
                }

            })
            $('#lotes').html(template)
        })
    }

})