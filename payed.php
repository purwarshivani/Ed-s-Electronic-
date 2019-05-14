<?php
require 'connect.php'; // link to connect.php

if(isset($_POST['pay'])){           //checking whether pay is set or not
        echo " succesfully payed";
};

?>


<?php
ob_start();
?>
<main><h1>Welcome to Ed's Electronics</h1>

	<div id="paypal-button-container"></div>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
        <script>
            paypal.Button.render({    //provides payapl buttons
                env: 'sandbox',    // environment variable for glean data from server.
                style: {          // styles for provided buttons
                    layout: 'vertical',  
                    size:   'responsive',    
                    shape:  'pill',      
                    color:  'gold'       
                },
                funding: {   // for funding resources 
                    allowed: [
                        paypal.FUNDING.CARD,    
                        paypal.FUNDING.CREDIT
                        
                    ],
                    disallowed: []
                },
                commit: true,  // for checkout and allow pay
                client: {  //paypal Id of client
                    sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                    production: '<insert production client id>'
                },

                payment: function (data, actions) {
                    return actions.payment.create({
                        payment: {
                            transactions: [
                                {
                                    amount: {
                                        total: '0.01',
                                        currency: 'USD'
                                    }
                                },

                            ]
                        }
                    });
                },

                onAuthorize: function (data, actions) {
                    return actions.payment.execute()
                        .then(function () {
                            window.alert('Payment Complete!');
                        });
                }
            }, '#paypal-button-container');
        </script>
        </script>
</main>
<?php
$main = ob_get_clean();

		require 'template.php'; 
?>