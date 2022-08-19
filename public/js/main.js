const boot = () => {
    handleHtmlAttributes();
    handleClickableButton();
};

// Boot
$(() => boot());

const handleHtmlAttributes = () => {
    let bodyHeight = $(document).height();
    let footerPosition = $("footer").position();

    $("footer").css({
        bottom: "-" + (bodyHeight - footerPosition.top - 40) + "px",
    });

    $("button[redirect]").on("click", function () {
        const url = $(this).attr("redirect");
        if (url) {
            window.location.href = url;
        }
    });
};

const selectCustomer = (customerId) => {
    $("#customer-id").val(customerId);
    $("#search-customer-close").trigger("click");
};

const handleClickableButton = () => {
    $("#search-customer-btn").on("click", function (e) {
        let keyword = $("#search-customer-input").val();
        if (keyword) {
            $.get("/search/customer?keyword=" + keyword, function (response) {
                if ($.isEmptyObject(response)) {
                    return;
                }

                $("#search-customer-result").html(`
                    <div onclick="selectCustomer(${response.customer.id})">
                        <div class="row">
                            <div class="col-4 header">Customer</div>
                            <div class="col-4 header">Contact</div>
                            <div class="col-4 header">Order</div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                ${response.address.name}<br>
                                ${response.address.address}<br>
                                ${response.address.country}<br>
                                ${response.address.state}<br>
                                ${response.address.zipcode}
                            </div>
                            <div class="col-4">
                                ${response.customer.name}<br>
                                ${response.customer.email}<br>
                                ${response.customer.company}
                            </div>
                            <div class="col-4">0</div>
                        </div>
                    </div>
                `);
            });
        }
    });
};


$(document).ready(function(){
    
	if($('.messages-list').length) {
		
		/* ---------- Check / Uncheck Checkbox ---------- */
		$('.messages-list').on('click', '.fa-square-o', function(event){
			event.preventDefault();
			
			$(this).removeClass('fa-square-o').addClass('fa-check-square-o');
			
		});
		
		$('.messages-list').on('click', '.fa-check-square-o', function(event){
			event.preventDefault();
			
			$(this).removeClass('fa-check-square-o').addClass('fa-square-o');
			
		});
		
		/* ---------- Check / Uncheck Stars ---------- */
		$('.messages-list').on('click', '.fa-star-o', function(event){
			event.preventDefault();
			
			$(this).removeClass('fa-star-o').addClass('fa-star');
			
		});
		
		$('.messages-list').on('click', '.fa-star', function(event){
			event.preventDefault();
			
			$(this).removeClass('fa-star').addClass('fa-star-o');
			
		});	
		
		/* ---------- White icons in active li---------- */
		$('.action').find('i.fa-square-o').replaceWith('<i class="fa fa-square-o"></i><i class="fa fa-square"></i>');
		$('.action').find('i.fa-star-o').replaceWith('<i class="fa fa-star-o"></i><i class="fa fa-star bg"></i>');
			
	}
	
	/* ---------- Placeholder Fix for IE ---------- */
	$('input, textarea').placeholder();

	/* ---------- Auto Height texarea ---------- */
	$('textarea').autosize();   
	
});
