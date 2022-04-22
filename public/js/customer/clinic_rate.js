$(function(){

    Clinic_rate();

    function Clinic_rate(){
        var id = $('#clinic_id').val();
        var rate;

        $.ajax({
            type: "GET",
            url: "/customer/rate/"+id,
            success: function(data){
                // console.log(data);

                rate = data.clinic_rate;
                document.getElementById("stars").innerHTML = getStars(rate);

                function getStars(rating) {
        
                    // Round to nearest half
                    rating = Math.round(rating * 2) / 2;
                    let output = [];
        
                    // Append all the filled whole stars
                    for (var i = rating; i >= 1; i--)
                        output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');
        
                    // If there is a half a star, append it
                    if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
        
                    // Fill the empty stars
                    for (let i = (5 - rating); i >= 1; i--)
                        output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');
        
                    return output.join('');
        
                }
        

            },
            error: function(){
                console.log('AJAX load did not work');
                // alert("error");
            }
        });
    
    }

})