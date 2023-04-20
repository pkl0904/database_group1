// Lấy đối tượng modal
var modal = document.getElementById("myModal");

// Lấy đối tượng button để mở modal
var btn = document.getElementById("import-btn");

// Lấy đối tượng button để đóng modal
var span = document.getElementsByClassName("close-btn")[0];

// Khi người dùng click vào button, mở modal
btn.onclick = function() {
  modal.style.display = "block";
}

// Khi người dùng click vào nút đóng (x), đóng modal
span.onclick = function() {
  modal.style.display = "none";
}

// Khi người dùng click bất kỳ đâu ngoài modal, đóng modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Khởi tạo đối tượng DataTable
$(document).ready(function() {
    $('#customer-table').DataTable();
});

document.body.classList.add('overlay');
var popup = document.createElement('div');
popup.classList.add('popup');
document.body.appendChild(popup);

const importButton = document.getElementById('import-button');
const closeButton = document.getElementById('close-btn');
const popupForm = document.querySelector('.popup-form');

importButton.addEventListener('click', function() {
  popupForm.style.display = 'block';
});

closeButton.addEventListener('click', function() {
  popupForm.style.display = 'none';
});
document.getElementById("close-btn").addEventListener("click", function() {
    document.getElementById("model-content").style.display = "block";
  });
  
  document.getElementById("close-btn").addEventListener("click", function() {
    document.getElementById("model-content").style.display = "none";
  });
    // Tạo danh sách các option trong dropbox Product ID
    var productIDSelect = document.getElementById("productID");
    for (var i = 1; i <= 50; i++) {
      var option = document.createElement("option");
      option.value = "Product" + i;
      option.text = "Product " + i;
      productIDSelect.add(option);
    }
function addProductInfo() {
    var productID = document.getElementById("productID").value;
    var quantity = document.getElementById("quantity").value;
    var amount = document.getElementById("amount").value;
    
    // Tạo một div mới để chứa thông tin về product
    var productInfoDiv = document.createElement("div");
    productInfoDiv.innerHTML = "Product ID: " + productID + "<br>" +
                               "Quantity: " + quantity + "<br>" +
                               "Amount: " + amount + "<br>" +
                               "<hr>";
    
    // Thêm div mới vào form lớn Purchase
    document.getElementById("productInfoContainer").appendChild(productInfoDiv);
    
    // Reset các giá trị trong form nhỏ Product ID
    document.getElementById("productID").value = "";
    document.getElementById("quantity").value = "";
    document.getElementById("amount").value = "";
}
      function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search-bar");
  filter = input.value.toUpperCase();
  table = document.getElementById("table-data");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
