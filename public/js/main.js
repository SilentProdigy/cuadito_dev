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
