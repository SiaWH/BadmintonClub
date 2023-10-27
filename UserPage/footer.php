
        <style>
            footer {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                background-color: #019875;
                font-size: medium;
                color: whitesmoke;
            }

            .footer {
                padding-bottom: 1%;
                text-align: center;
                width: 33%;
            }

            .footer h1 {
                text-decoration: underline;
                padding-bottom: 1%;
            }

            .footer h1,
            h4,
            .footer p {
                text-align: center;

            }

            .linkBox {
                text-align: center;
            }

            .aBox {
                text-align: center;
            }

            abox.a {
                text-decoration: none;
            }

            .icon img {
                width: 45px;
                border-radius: 50%;

            }  
                  
            @media only screen and (max-width: 725px){
                .footer{
                    width: 50%;
                    margin: 0 auto 0 auto;
                }
            }
            
            @media only screen and (max-width: 500px) {
                .footer {
                    width: 80%;
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                }
            }
        </style>
 
        <footer>
            
            <div class="footer">
                <h1>Address</h1>
                <h4>TARUMT BADMINTON CLUB</h4>
                <p>Kampus Utama, Jalan Genting Kelang,<br>53300 Kuala Lumpur,<br>Wilayah Persekutuan Kuala Lumpur</p>
            </div>


            <div class="footer">

                <h1>Links</h1>

                <div class="linkBox">
                    <a href="https://www.facebook.com/tarumtkl/?locale=ms_MY" class="icon"
                        style="text-decoration:none;" target="_blank"><img src="Picture/facebook.jpg"></a>

                    <a href="https://www.instagram.com/tarumt.official/?hl=en" class="icon"
                        style="text-decoration:none;" target="_blank"><img src="Picture/instagram.jpg"></a>
                </div>

            </div>

            <div class="footer">

                <h1>Contact Us</h1>

                <div class="aBox">
                    <a href="tel:0123456789">&#9742;Call Us&#9742;</a><p>012-123456789</p>
                    <a href="mailto:TARUMTbadmintonclub@gmail.com">&#9993;Mail Us&#9993;</a><p>TARUMTbadmintonclub@gmail.com</p>
                </div>

            </div>
            
        </footer>
    </body>
</html>
