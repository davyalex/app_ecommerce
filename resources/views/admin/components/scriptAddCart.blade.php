<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css
" rel="stylesheet">

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
    $('.addCart').click(function(e) {

        e.preventDefault();
        //option of taille and pointure checked
        var options = $('.optionChecked:checked').map(function() {
            return this.value;
        }).get();

        //get Option name and verify if option name existe
        var optionName = $(".optionChecked").attr("name") ? $(".optionChecked").attr("name") :
            'optionNameNoExist';

        //verify if option existe 
        var optionExist = optionName === 'optionNameNoExist' ? 'optionNoExist' : 'optionExist';
        console.log(optionExist);


        if (options.length === 0 && optionExist === 'optionExist') {
            Swal.fire({
                text: "Veuillez choisir une " + optionName,
                // icon: 'warning',
                width: '350px',
                showCancelButton: false,
                confirmButtonColor: '#212529',
                cancelButtonColor: '#212529',
                confirmButtonText: 'Choisir'
            })
        } else {
            var getId = e.target.dataset.id;
            $.ajax({
                type: "GET",
                url: "/add-to-cart/" + getId,
                data: {
                    getId,
                    options,
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('.cart-badge').html(response.countCart)
                    //   $('.pro-quantity').html(response.qte)
                    //   $('.cart-price').html(response.price)
                    //   $('.get-total').html(response.total)
                    //   $('.img-cart').html('<img  src="'+response.image+ '">')
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Produit ajouté avec succès',
                        animation: false,
                        position: 'top',
                        background: '#3da108e0',
                        iconColor: '#fff',
                        color: '#fff',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                    });

                }
            });
        }

    });
</script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js
"></script>
