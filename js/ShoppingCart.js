$(document).ready(function () {
    getLocalStorageCart();
    getLocalStorageCart_Order()
    $(document).on('click', '.addCart', (e) => {
        const element = $(e.currentTarget).closest('[prodId]'); // Encuentra el elemento padre con el atributo prodId
        const id = element.attr('prodId');
        const name = element.attr('prodName');
        const concentration = element.attr('prodConcentration');
        const extra = element.attr('prodExtra');
        const price = element.attr('prodPrice');
        const laboratory = element.attr('prodLaboratory');
        const type = element.attr('prodType');
        const presentation = element.attr('prodPresentation');
        const avatar = element.attr('prodAvatar');
        const stock = element.attr('prodStock');

        const newProduct = {
            id: id,
            name: name,
            concentration: concentration,
            extra: extra,
            price: price,
            laboratory: laboratory,
            type: type,
            presentation: presentation,
            avatar: avatar,
            quantity: 1,
            stock:stock
        };

        // Añadir o actualizar producto en el Local Storage
        addOrUpdateLocalStorage(newProduct);

        // Refrescar la lista del carrito y el contador
        refreshCartList();
    });

    $(document).on('click', '.deleteProductCart', (e) => {
        const element = $(e.currentTarget).closest('tr');
        const id = element.attr('prodId');
        console.log(id);
        element.remove();
        deleteLocalStorageProduct(id);
        calculateTotal()
        // Refrescar la lista del carrito y el contador
        refreshCartList();
    });


    $(document).on('click', '#emptyCart', (e) => {
        $('#list').empty();
        localStorage.removeItem('products'); // Limpia el localStorage
        updateCounter(0); // Actualiza el contador a 0
    });

    function getLocalStorage() {
        let products;
        if (localStorage.getItem('products') === null) {
            products = [];
        } else {
            products = JSON.parse(localStorage.getItem('products'));
        }
        return products;
    }

    function addOrUpdateLocalStorage(newProduct) {
        let products = getLocalStorage();
        let productExists = false;

        products = products.map(product => {
            if (product.id === newProduct.id) {
                productExists = true;
                product.quantity += 1; // Incrementa la cantidad
                return product;
            }
            return product;
        });

        if (!productExists) {
            products.push(newProduct);
        }

        localStorage.setItem('products', JSON.stringify(products));
    }

    function refreshCartList() {
        $('#list').empty();
        getLocalStorageCart();
    }

    $(document).on('click','#buyybaby',(e)=>{
        processOrder()
    })
    $(document).on('click','#processOrderButton',(e)=>{
        processOrderBuy()
    })


    function getLocalStorageCart() {
        let products = getLocalStorage();
        let totalQuantity = 0;
        products.forEach(product => {
            const template = `
                <tr prodId="${product.id}">
                    <td>${product.stock}</td>
                    <td>${product.name}</td>
                    <td>${product.concentration}</td>
                    <td>${product.laboratory}</td>
                    <td>${product.price}</td>
                    <td>${product.quantity}</td>
                    <td><button class="deleteProductCart btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
            `;
            $('#list').append(template);


            totalQuantity += product.quantity; // Suma la cantidad del producto al total
        });
        updateCounter(totalQuantity); // Actualiza el contador con el total de cantidades
    }

    function deleteLocalStorageProduct(id) {
        let products = getLocalStorage();
        products = products.filter(product => product.id !== id);
        localStorage.setItem('products', JSON.stringify(products));
    }

    function updateCounter(total) {
        $('#counter').html(total); // Actualiza el contenido del span con el ID counter
    }

    function processOrder(){
        let products
        products = getLocalStorage()
        if(products.length===0){
            Swal.fire({
                icon: 'error',
                title: 'Oops..',
                text: 'El carrito se encuentra vacio'
            })
        }else{
            location.href='../vista/adm_order.php'
        }
    }



$('#orderTable').keyup((e)=>{
    calculateTotal()
})
    function getLocalStorageCart_Order() {
        let products = getLocalStorage();
        let totalQuantity = 0;
        products.forEach(product => {
            const template = `
                <tr prodId="${product.id}">
                 <td>${product.name}</td>
                    <td>${product.stock}</td>
                  <td>${product.price}</td>
                    <td>${product.concentration}</td>
                    <td>${product.laboratory}</td>
                    <td class="quantityProduct">${product.quantity}</td>
                    <td class="subTotal">
                    <h5>${product.price*product.quantity}</h5>
                    </td>                  
                    <td><button class="deleteProductCart btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
            `;
            $('#orderListB').append(template);
            totalQuantity += product.quantity; // Suma la cantidad del producto al total
            calculateTotal()
        });
        updateCounter(totalQuantity); // Actualiza el contador con el total de cantidades
    }

    $()
   function calculateTotal(){

    let total=0,iva=0.16,totalWithoutDiscount,payment,change,discount;
    let subtotal,withIva;
       let products=getLocalStorage()
       products.forEach(product=>{
           let subtotal_Product=Number(product.price*product.quantity)
           total = total+subtotal_Product
       })

       payment=$('#pay').val()
       discount=$('#discount').val()
console.log(discount)

       totalWithoutDiscount=total.toFixed(2)
       withIva=parseFloat(total*iva).toFixed(2)
       subtotal=parseFloat(total-withIva).toFixed(2)

       total=total-discount
       change=payment-total

       $('#subtotal').html(subtotal)
       $('#Iva').html(withIva)
       $('#totalWithoutDiscount').html(totalWithoutDiscount)
       $('#totalDiscount').html(total)
       $('#change').html(change)
   }

    function emptyCart() {
        $('#list').empty();
        localStorage.removeItem('products'); // Limpia el localStorage
        updateCounter(0); // Actualiza el contador a 0
    }

   function processOrderBuy() {
        let name;

        name = $('#client').val()
       if(getLocalStorage().length == 0){
           Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "No hay productos en el carrito!",


           })
               .then(function (){
                   location.href='../vista/adm_Catalogue.php'
               })
       }else if(name==''){
           Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "Se necesita un nombre de cliente!",

           });
       }else{
           checkStock().then(error=>{
              if(error==0){
                  RegisterOrder(name)
                  Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "Se realizó la compra",
                      showConfirmButton: false,
                      timer: 1500
                  })

                      .then(function (){
                          emptyCart();
                          location.href='../vista/adm_Catalogue.php'
                      })

              }else{
                  Swal.fire({
                      icon: "error",
                      title: "Oops...",
                      text: "Hay un problema con el stock de algun producto!",

                  });
              }
           })

       }
   }

   async function checkStock() {
       let products

       funcion = 'checkStock'
       products = getLocalStorage()
       const response = await fetch('../controller/ProductController.php', {
           method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
           body:'funcion='+funcion+'&& products='+JSON.stringify(products)
       })
let error= await response.text()
       return error;
   }

        function  RegisterOrder(name){

            funcion ='registerOrder'
            let total =$('#totalDiscount').get(0).textContent
            let products = getLocalStorage()
            let json = JSON.stringify(products)
            $.post('../controller/OrderController.php',{funcion,total,name,json},(response)=>{
                console.log(response)
            })


        }

});
