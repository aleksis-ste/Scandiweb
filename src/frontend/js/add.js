$(document).ready(() => {
    $('#type').change(function() {
        switch (this.value) {
            case '0':
                $('#attributes').html(`
                    <label for="size">Size</label>
                    <input type="number" step="0.01" class="form-control" name="size" required>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                `);
                break;
            case '1':
                $('#attributes').html(`
                    <label for="weight">Weight</label>
                    <input type="number" step="0.01" class="form-control" name="weight" required>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                `);
                break;

            case '2':
                $('#attributes').html(`
                    <label for="height">Height</label>
                    <input type="number" step="0.01" class="form-control" name="height" required>
                    <label for="width">Width</label>
                    <input type="number" step="0.01" class="form-control" name="width" required>
                    <label for="length">Length</label>
                    <input type="number" step="0.01" class="form-control" name="length" required>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                `);
                break;
        }
    });

    $('form').submit(function(e) 
    {
        e.preventDefault();

        let inputs = {};
        $(this).find(':input').each(function() {
            inputs[$(this).attr("name")] = $(this).val();
        });

        $.post('/products/add', inputs, function(data, status) {
            $('#message').show().removeClass('alert-success alert-danger').addClass(`alert-${data.status}`).html(data.message);
        });
    });
});