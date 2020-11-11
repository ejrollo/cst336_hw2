<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8" />
        
        <title>Slot Sim</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
        crossorigin="anonymous">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.11.0/underscore-min.js"></script>
        
        <script>
            $(document).ready(function(){
               
               /*global _*/
               /*global $*/
               
               //global variables
               var cardsArray = ["AC","AD","AH","AS","JC","JD","JH","JS","KC","KD","KH","KS",
                        "QC","QD","QH","QS"];
               var maxCards = 3;
               var matchTwo;
               var matchThree;
               var winnings = 0;
               
               //event listener to spin
               $("button").on("click", spin);
               
               displayCards();
               
                function displayCards(){
                    $("#cardsDisplay").html("");
                    cardsArray = _.shuffle(cardsArray);
                    
                    for(let i = 0; i < maxCards; i++){
                        $("#cardsDisplay").append(` <img src="img/${cardsArray[i]}.png" alt="${cardsArray[i]}"
                            style="width:220px;height:300px;"/> `);
                    }
                }//end displayCards
                
                function isWinnner(){
                    let winner = false;
                    let cardOne = cardsArray[0].charAt(0);
                    let cardTwo = cardsArray[1].charAt(0);
                    let cardThree = cardsArray[2].charAt(0);
                    
                    if (cardOne == cardTwo && cardOne == cardThree){
                        matchThree = true;
                        winner = true;
                    } else if (cardOne == cardTwo){
                        matchTwo = true;
                        winner = true;
                    } else if (cardOne == cardThree){
                        matchTwo = true;
                        winner = true;
                    } else if (cardTwo == cardThree){
                        matchTwo = true;
                        winner = true;
                    } else{
                        matchTwo = false;
                        matchThree = false;
                    }
                    return winner;
                }
                
                function isBetValid(){
                    let isValid = true;
                    let wager = parseFloat($("#bet").val(), 2);
                    if ($("#bet").val() == "") {
                        isValid = false;
                        $("#betFdbk").html("You Didn't Enter a Bet, Enter a Bet to Play");
                    } else if (!$.isNumeric(wager)){
                        isValid = false;
                        $("#betFdbk").html("Your Bet is Not a Number, Enter a Bet to Play");
                    } else if (wager < 5){
                        isValid = false;
                        $("#betFdbk").html("Bet is Too Low, Enter a New Bet ($5 - $100) to Play");
                    } else if (wager >100){
                        isValid = false;
                        $("#betFdbk").html("Bet is Too High, Enter a New Bet ($5 - $100) to Play");
                    } else{
                        $("#betFdbk").html("");
                    }
                    return isValid;
                }
                
                
                
                function spin(){
                    $("#winTwoFdbk").html("");
                    $("#winThreeFdbk").html("");
                    $("#loseFdbk").html("");
                    if(!isBetValid()){
                       return;
                    }
                    
                    displayCards();
                    
                    if (isWinnner()){
                        if (matchTwo){
                            let wager = parseFloat($("#bet").val(), 2);
                            wager = wager * 1.25;
                            $("#winTwoFdbk").html("YOU WON $" + wager + ", MATCHED 2!");
                        } else if (matchThree){
                            let wager = parseFloat($("#bet").val(), 2);
                            wager = wager * 10;
                            $("#winThreeFdbk").html("YOU WON $" + wager + ", MATCHED 3!");
                        }
                    } else {
                        $("#loseFdbk").html("YOU LOST, TRY AGAIN");
                    }
                }//end spin

            })
        </script>
        
    </head>
    <body class="text-center">
        
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 style="color:red;"> <strong> SLOT MACHINE POKER </strong></h1>
                <h2> Match 2 of any suite and you WIN 125%!</h2>
                <h2> Match 3 of any suite and you WIN <strong>BIG! 1000%</strong></h2>
            </div>
        </div>
        
        <h2>YOUR SPIN</h2>
        <div id="winTwoFdbk" class="bg-warning text-white"></div>
        <div id="winThreeFdbk" class="bg-success text-white"></div>
        <div id="loseFdbk" class="bg-danger text-white"></div>
        <br>
        <div id="cardsDisplay"></div>
        <br><br>
        
        <div id="betFdbk" class="bg-danger text-white"></div>
        <br>
        <input type="text" id="bet">
        <br><br>
        <h3> ENTER A WAGER ($5 - $100) </h3>
        <br>
        </div>
        
        <div class="container">
            <button type="button" class="btn btn-danger btn-lg btn-block"> SPIN </button>
            <br>
        </div>
        
        
    </body>
    
    <footer>
            <hr>
                <img src="img/csumblogo.png" alt="CSUMB Logo" style="width:200px;height:200px;"/> <br />
                CST336 Internet Programming. 2020&copy; Rollo <br />
                <strong>Disclaimer:</strong> The information in this webpage is fictitious. <br />
                It is used for academic purposes only. The slot machine is only a simulator with no $$ changing hands
                <br><br>
        </footer>
</html>