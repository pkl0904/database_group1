function searchCustomer() {
  var customerId = document.getElementById("customer-id-input").value;
  $.ajax({
    url: "search_customer.php", // Đường dẫn đến file PHP xử lý tìm kiếm
    method: "POST",
    data: {customerid: customerId},
    success: function(response) {
      // Hiển thị kết quả tìm kiếm lên trang web HTML
      document.getElementById("customer-info").innerHTML = response;
    }
  });
}
