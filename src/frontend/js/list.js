$(document).ready(() => {
    function getProducts()
    {
        $('.products').html('');
        $.get('/products/get', function(products, status) {
            if(Array.isArray(products))
            products.forEach(product => {
                $('.products').append(`
                <div class="col-3 pb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="products[]" value="${product.sku}">
                                </label>
                            </div>
                            <h4 class="card-title">${product.sku}</h4>
                            <p class="card-text">${product.name}</p>
                            <p class="card-text">${product.price}$</p>
                            <p class="card-text">${product.type == 0 ? 'Size: ' : product.type == 1 ? 'Weight: ' : 'Dimension: '}${product.attribute}</p>
                        </div>
                    </div>
                </div>
                `);
            });
        });
    }

    getProducts();

    $('form').submit(function(e) {
        e.preventDefault();

        let items = {};
        $.each($("input[name='products[]']:checked"), function(index){
            items[index] = $(this).val();
        });

        if(items[0])
        {
            $.post('/products/delete', items, function(data, status) {
                $('#message').show().html(data.message);
                getProducts();
            });
        }
    })
});