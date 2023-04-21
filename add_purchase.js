var productInfo = [];

const buttonAddProduct = document.getElementById("addProductInfoBtn");

buttonAddProduct.addEventListener("click", addProductInfo);

function addProductInfo() {
  var productID = document.getElementById("productID").value;
  var quantity = document.getElementById("quantity").value;
  var amount = document.getElementById("amount").value;

  var product = {
    productID: productID,
    quantity: quantity,
    amount: amount,
  };
  productInfo.push(product);

  // Tạo một div mới để chứa thông tin về product
  var productInfoDiv = document.createElement("div");
  productInfoDiv.innerHTML =
    "Product ID: " +
    productID +
    "<br>" +
    "Quantity: " +
    quantity +
    "<br>" +
    "Amount: " +
    amount +
    "<br>" +
    "<hr>";

  // Thêm div mới vào form lớn Purchase
  document.getElementById("productInfoContainer").appendChild(productInfoDiv);

  // Reset các giá trị trong form nhỏ Product ID
  document.getElementById("productID").value = "";
  document.getElementById("quantity").value = "";
  document.getElementById("amount").value = "";

  const productInfoHTML = document.getElementById("productInfo");
  productInfoHTML.value = JSON.stringify(productInfo);
}
