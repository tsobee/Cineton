$(document).ready(function(){

    var url=location.href;
    var page=url.split('/')[url.split('/').length-1];
    if(page.indexOf("index.php")!=-1 || page==""){
        sledeceNaRepertoaru()
        cenovnik();
    }
    if(page.indexOf("movies.php") != -1){
        dohvatanjeFilmova()
        }
    if(page.indexOf("reservation.php")!=-1){
        promenaUkupno()
    }


   
    setTimeout(function(){
        document.querySelector(".animation").animate(
            {opacity:0},
            { duration: 300, fill: 'forwards' }
        );
        window.location.replace("/php1sajt/adminUsers.php");
    },1000)
    setTimeout(function(){
        document.querySelector(".animationRes").animate(
            {opacity:0},
            { duration: 300, fill: 'forwards' }
        );
        window.location.replace("/php1sajt/adminReservation.php");
    },1000)
    setTimeout(function(){
        document.querySelector(".animationMovies").animate(
            {opacity:0},
            { duration: 300, fill: 'forwards' }
        );
        window.location.replace("/php1sajt/adminMovies.php");
    },1000)
    setTimeout(function(){
        document.querySelector(".animationRep").animate(
            {opacity:0},
            { duration: 300, fill: 'forwards' }
        );
        window.location.replace("/php1sajt/adminRep.php");
    },1000)
        const sideNavOpenDuration = 300;
        function closeSideNav() {
            $('#sideNavContent').css('transform', 'translateX(-100%)');
            setTimeout(function() {
                $('#sideNav').fadeOut('fast');
            }, sideNavOpenDuration);
        }
    
    $('#sideNavContent').css('transition', `transform ${sideNavOpenDuration / 1000}s`);
    $('#sideNav').hide();
    $('#hamburger a').click(function(e) {
        $('#sideNav').fadeIn('fast', function() {
            $('#sideNavContent').css('transform', 'translateX(0px)');
        });
        e.preventDefault();
    });
    $('#sideNav .cover').click(closeSideNav);
    $('#sideNavContent').click(function(e) {
        e.stopPropagation();
    });

    function cenovnik(){
        $.ajax({
            url:"php/stranice/cenovnik.php",
            method:"get",
            dataType:"json",
            success:function(data){
                
                ispisCenovnik(data)
            },
            error:function(xhr){
                
                $("#cenovnik").html(xhr.responseText)
                console.log(xhr.responseText);
            }
        })
    }
    
    function ispisCenovnik(data){
        var ispis='<tr><th>Name</th><th>Price</th></tr>'
        for(let d of data){
            ispis+=`<tr><td>${d.filmName}</td><td>${d.price}` 
            ispis+=`&euro;</td></tr>`
        }
        $("#cenovnik table").html(ispis)
    }

    function sledeceNaRepertoaru(){
        $.ajax({
            url:"php/stranice/naRepertoaru.php",
            method:"get",
            dataType:"json",
            success:function(naRepertoaru){
                sledeceIspis(naRepertoaru)
            },
            error:function(xhr){
                $("#sledece").html(xhr.responseText)
            }
        })
    }

    function sledeceIspis(naRepertoaru){
        var s="";
        s+=`
            <div class="sledece">
                <div>
                    <p id="sledeceNaslov">Next to watch<p>
                    <h2>${naRepertoaru.filmName}</h2>
                    <p class="datumSledece">Date: ${naRepertoaru.screeningDate.split("-")[2]}.${naRepertoaru.screeningDate.split("-")[1]}.${naRepertoaru.screeningDate.split("-")[0]}.</p>
                </div>
                <div>
                    <a href="oneMovie.php?id=${naRepertoaru.idFilm}">Show more</a>
                </div>
            </div>
            <div class="sledece">
                <img src="assets/img/${naRepertoaru.pictureSrc}" alt="${naRepertoaru.pictureAlt}" class="slikaSledece"/>
            </div>
        `
        $("#naRepertoaru").html(s)
    }

    function dohvatanjeFilmova(){
        $.ajax({
            url:"php/stranice/ispisFilmova.php",
            method:"get",
            dataType:"json",
            success:function(ispisFilmova){
                ispisFilm(ispisFilmova)
            },
            error:function(xhr){
                console.log(xhr.responseText)
                $("#moviesId").html(xhr.responseText)
            }
        })
    }

    function ispisFilm(ispisFilmova){
        var films="";    
        ispisFilmova.forEach(e => {
            films+=
            `
    <div class="card-deck mb-5 movieOne">
        <div class="card">
            <img class="card-img-top slikaMovie" src="assets/img/${e.pictureSrc}" alt="${e.pictureAlt}">
            <div class="card-body">
            <h4 class="card-title naslovTxt">${e.filmName}</h4>
            <span class="naslovTxt">Duration: ${e.duration} min</span>
            <span class="naslovTxt">Premiere: ${e.premiere.split("-")[2]}.${e.premiere.split("-")[1]}.${e.premiere.split("-")[0]}</span><br/>
            <a class="details" href="oneMovie.php?id=${e.idFilm}">Details</a>
            </div>
        </div>
    </div>
        `
        });
        $("#moviesId").html(films)
    }

    $("#btnAnketa").click(function(){
        if(!$(".rdb:checked").val()){
            $("#poruka").html("You need to check something");

        }else{
            $.ajax({
                url:"php/stranice/obradaAnkete.php",
                method:"post",
                dataType:"json",
                data:{
                    odg:$(".rdb:checked").val(),
                    dugme: true
                },
                success:function(data){
                    $("#poruka").html("You have successfully completed the survey")
                    $("#drzacAnkete").hide();
            },
                error:function(xhr){
                    console.log(xhr.responseText)
                $("#poruka").html(xhr.responseText)
            }
            })
        }
    });
    //forma
    $(".btnAjax").click(function(){

        var imePrezime = $("#name");
        var email = $("#email");
        var tel = $("#phone");

        var brojac = 0;

        var regExImePrezime = /^[A-ZĐŠČĆŽ][a-zđšćčž]{2,}(\s[A-ZĐŠČĆŽ][a-zđšćčž]{2,})$/
        var regExMail = /^[a-z][a-z0-9\.]{2,}@([a-z0-9]{2,}\.)+[a-z]{2,}$/
        var regExTelefon = /^[0-9]{3}(-?[0-9]{3,4}){2}$/

        //imePrezime
        if(imePrezime.val() == ''){
            imePrezime.css({
            'border':'1px solid  #e60000'
            });
            imePrezime.val("");
            imePrezime.attr('placeholder','Name can not be empty');
            brojac++;
        }
    
        else if(!regExImePrezime.test(imePrezime.val())){
            imePrezime.css({
            'border':'1px solid  #e60000'
            });
            imePrezime.val("");
            imePrezime.attr('placeholder','e.g. First Second');
            brojac++;
        }
        else {
            imePrezime.css({
            'border':'1px solid  #fff'
            });
            
        }
        //email
        if(email.val() == ''){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','Email adress can not be empty');
            brojac++;
        }
        else if(!regExMail.test(email.val())){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','e.g. yourmail@gmail.com');
            brojac++;
        }
        else {
            email.css({
            'border':'1px solid  #fff'
            });
            
        }
        //telefon
        if(tel.val() == ""){
            tel.css({
                'border':'1px solid #e60000'
            });
            tel.val("");
            tel.attr("placeholder","Number can not be empty");
            brojac++;
        }
        else if(!regExTelefon.test(tel.val())){
            tel.css({
                'border':'1px solid #e60000'
            });
            tel.val("");
            tel.attr("placeholder","e.g. xxx-xxx-xxxx");
            brojac++;
        }
        else{
            tel.css({
                'border':'1px solid #fff'
            });
        }
        var tekstPolje =$("#msg");
    
        if(tekstPolje.val() == ''){
            tekstPolje.css({
            'border':'1px solid  #e60000'
            });
        
            tekstPolje.val("");
            tekstPolje.attr('placeholder','Message can not be empty');
            brojac++;
        }
        else {
            tekstPolje.css({
            'border':'1px solid  #fff'
            });
        }

        if(brojac == 0){
            $.ajax({

                url:"php/stranice/obradaForme.php",
                method:"POST",
                dataType:"json",
                data :{
                    imePrezime : imePrezime.val(), 
                    email : email.val(),
                    telefon : tel.val(),
                    msg : tekstPolje.val(),
                    btnPosalji : $(".btnAjax").val()
                },
                success : function(data){
                    console.log(data);
                    document.querySelector("#contact").reset();
                    $("#valid").html(data);
                },
                error : function(err){
                    console.error(err.responseText);
                    $("#valid").html(err.responseText.replaceAll('"',""));
                }
            });
        }

        return false;
    })
    // login
    $("#loginBtn").click(function(){
        
        var email = $("#emailLogin");
        var pass = $("#passwordLogin");
        var brojac = 0;
        
        var regExMail = /^[a-z][a-z0-9\.]{2,}@([a-z0-9]{2,}\.)+[a-z]{2,}$/
        var regExpPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

        if(email.val() == ''){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','Email adress can not be empty');
            brojac++;
        }
        else if(!regExMail.test(email.val())){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','e.g. yourmail@gmail.com');
            brojac++;
        }
        else {
            email.css({
            'border':'1px solid  #c2c2c2'
            });
            
        }

        if(pass.val() == ''){
            pass.css({
            'border':'1px solid  #e60000'
            });
            pass.val("");
            pass.attr('placeholder','Password can not be empty');
            brojac++;
        }
        else if(!regExpPassword.test(pass.val())){
            pass.css({
            'border':'1px solid  #e60000'
            });
            pass.val("");
            pass.attr('placeholder','e.g. Password123!');
            brojac++;
        }
        else {
            pass.css({
            'border':'1px solid  #c2c2c2'
            });
            
        }

        if(brojac == 0){
            $.ajax({

                url:"php/stranice/obradaLogin.php",
                method:"POST",
                dataType:"json",
                data :{
                    email : email.val(),
                    pass : pass.val(),
                    btnLogin : $("#loginBtn").val()
                },
                success : function(data){
                    if(data=="Ok"){
                        window.location.href="index.php";
                    }else{
                    $("#validLogin").html(data);
                    }
                },
                error : function(err){
                    console.error(err.responseText);
                    $("#validLogin").html(err.responseText.replaceAll('"',""));
                }
            });
        }
        return false;
    });

    // register
    $("#registerBtn").click(function(){

        var fullName=$("#name")
        var username= $("#username")
        var email = $("#email");
        var pass = $("#password");
        var passConfirm = $("#confirm")
        var brojac = 0;
    
        var regExFullName = /^[A-ZĐŠČĆŽ][a-zđšćčž]{2,}(\s[A-ZĐŠČĆŽ][a-zđšćčž]{2,})$/
        var regExUsername = /^[a-zA-Z]\w{4,}$/;
        var regExMail = /^[a-z][a-z0-9\.]{2,}@([a-z0-9]{2,}\.)+[a-z]{2,}$/
        var regExpPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;

        if(fullName.val() == ''){
            fullName.css({
            'border':'1px solid  #e60000'
            });
            fullName.val("");
            fullName.attr('placeholder','Full name can not be empty');
            brojac++;
        }  
        else if(!regExFullName.test(fullName.val())){
            fullName.css({
            'border':'1px solid  #e60000'
            });
            fullName.val("");
            fullName.attr('placeholder','e.g. First Second');
            brojac++;
        }
        else {
            fullName.css({
            'border':'1px solid  #fff'
            });
            
        }

        if(username.val() == ''){
            username.css({
            'border':'1px solid  #e60000'
            });
            username.val("");
            username.attr('placeholder','Username can not be empty');
            brojac++;
        }
        else if(!regExUsername.test(username.val())){
            username.css({
            'border':'1px solid  #e60000'
            });
            username.val("");
            username.attr('placeholder','e.g. Username');
            brojac++;
        }
        else {
            email.css({
            'border':'1px solid  #c2c2c2'
            });
            
        }


        if(email.val() == ''){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','Email adress can not be empty');
            brojac++;
        }
        else if(!regExMail.test(email.val())){
            email.css({
            'border':'1px solid  #e60000'
            });
            email.val("");
            email.attr('placeholder','e.g. yourmail@gmail.com');
            brojac++;
        }
        else {
            email.css({
            'border':'1px solid  #c2c2c2'
            });
            
        }

        if(pass.val() == ''){
            pass.css({
            'border':'1px solid  #e60000'
            });
            pass.val("");
            pass.attr('placeholder','Password can not be empty');
            brojac++;
        }
        else if(!regExpPassword.test(pass.val())){
            pass.css({
            'border':'1px solid  #e60000'
            });
            pass.val("");
            pass.attr('placeholder','e.g. Password123!');
            brojac++;
        }
        else {
            pass.css({
            'border':'1px solid  #c2c2c2'
            });
            
        }
  
        if(passConfirm.val() == ''){
            passConfirm.css({
            'border':'1px solid  #e60000'
            });
            passConfirm.val("");
            passConfirm.attr('placeholder','Confirm your password');
            brojac++;
        }
        else if(passConfirm.val() != pass.val()){
            passConfirm.css({
            'border':'1px solid  #e60000'
            });
            passConfirm.val("");
            passConfirm.attr('placeholder','Incorrect, please try again');
            brojac++;
        }
        else {
            passConfirm.css({
            'border':'1px solid  #c2c2c2'
            });
            
        }

        if(brojac == 0){
            $.ajax({
    
                url:"php/stranice/obradaRegister.php",
                method:"POST",
                dataType:"json",
                data :{
                    name: fullName.val(),
                    username :username.val(),
                    email : email.val(),
                    pass : pass.val(),
                    btnRegister : $("#registerBtn").val()
                },
                success : function(data){
                    if(data=="Successfully."){
                        $("#emailLogin").val(email.val())
                        document.querySelector("#registerForm").reset();
                    }else{
                    $("#valid").html(data);
                    }
                },
                error : function(err){
                    console.error(err.responseText);
                    $("#valid").html(err.responseText.replaceAll('"',""));
                }  
            });
        }  
        return false;
    })

    // reservation

    function promenaUkupno(){
        var cena=$("#cena").html()
        console.log(cena);
        var brKarata=$("#brojKarata").val();
        console.log(brKarata);
        var ukupnaCena=0;
        if(brKarata>0){
            ukupnaCena=brKarata*cena;
        }
        $("#ukupno").html(ukupnaCena)
    }
    $("#brojKarata").change(promenaUkupno);


});
