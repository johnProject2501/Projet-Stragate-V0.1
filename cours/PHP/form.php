<html>
    <form method="post" action="#">
        <fieldset>
            <label>mdp</label>
            <input type="text" value="" placeholder="mdp" id="pwd">
            <label>confirm mdp</label>
            <input type="text" value="" placeholder="confirme mdp" id="confirmed">
        </fieldset>

    <button type="submit">envoie</button>


    </form>

    <script type="text/javascript">
        function Validation(evt){
            evt.preventDefault();
            var password = document.getElementById('pwd').value;
            var password2 = document.getElementById('confirmed').value;

            if(password.length===0){
                document.getElementById('pwd').style.borderColor="red";
                return;

            }
            else if (password !== password2){
                document.getElementById('confirmed').style.bordercolor="red";
                return;
            }
            console.log('OK');

            var myform =document.querySelector('form');
            myform.addEventListener('submit',validateForm);
        }
    </script>



    <button onclick="getLocation()">Try It</button>

    <p id="demo"></p>

    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        }
    </script>


</html>