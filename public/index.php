<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRUD Laravel API - Clientes y Productos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      padding: 40px;
    }
    h1, h2 {
      color: #2c3e50;
    }
    input, button, select {
      padding: 8px;
      margin: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      cursor: pointer;
      background: #3498db;
      color: white;
      border: none;
    }
    button:hover {
      background: #2980b9;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background: white;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background: #34495e;
      color: white;
    }
    .section {
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      margin-bottom: 40px;
    }
  </style>
</head>
<body>

  <h1>CRUD Laravel API</h1>

  <!-- CLIENTES -->
  <div class="section">
    <h2>Clientes</h2>
    <div>
      <input type="text" id="clientName" placeholder="Nombre">
      <input type="email" id="clientEmail" placeholder="Correo">
      <input type="text" id="clientPhone" placeholder="Teléfono">
      <input type="text" id="clientAddress" placeholder="Dirección">
      <button onclick="createClient()">Agregar Cliente</button>
    </div>

    <table id="clientsTable">
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Dirección</th><th>Acciones</th></tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- PRODUCTOS -->
  <div class="section">
    <h2>Productos</h2>
    <div>
      <input type="text" id="productName" placeholder="Nombre del producto">
      <input type="text" id="productCategory" placeholder="Categoría">
      <input type="number" id="productPrice" placeholder="Precio">
      <input type="number" id="productStock" placeholder="Stock">
      <select id="productClient"></select>
      <button onclick="createProduct()">Agregar Producto</button>
    </div>

    <table id="productsTable">
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Cliente</th><th>Acciones</th></tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    const API = "http://127.0.0.1:8000/api";

    // ======================= CLIENTES =========================
    async function loadClients() {
      const res = await fetch(`${API}/clients`);
      const data = await res.json();
      const tbody = document.querySelector("#clientsTable tbody");
      const select = document.getElementById("productClient");
      tbody.innerHTML = "";
      select.innerHTML = "<option value=''>-- Sin cliente --</option>";

      data.forEach(c => {
        tbody.innerHTML += `
          <tr>
            <td>${c.id}</td>
            <td>${c.name}</td>
            <td>${c.email}</td>
            <td>${c.phone || ""}</td>
            <td>${c.address || ""}</td>
            <td><button onclick="deleteClient(${c.id})">🗑️</button></td>
          </tr>`;
        select.innerHTML += `<option value="${c.id}">${c.name}</option>`;
      });
    }

    async function createClient() {
      const name = document.getElementById("clientName").value;
      const email = document.getElementById("clientEmail").value;
      const phone = document.getElementById("clientPhone").value;
      const address = document.getElementById("clientAddress").value;

      await fetch(`${API}/clients`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, email, phone, address })
      });
      loadClients();
    }

    async function deleteClient(id) {
      await fetch(`${API}/clients/${id}`, { method: "DELETE" });
      loadClients();
    }

    // ======================= PRODUCTOS =========================
    async function loadProducts() {
      const res = await fetch(`${API}/products`);
      const data = await res.json();
      const tbody = document.querySelector("#productsTable tbody");
      tbody.innerHTML = "";
      data.forEach(p => {
        tbody.innerHTML += `
          <tr>
            <td>${p.id}</td>
            <td>${p.name}</td>
            <td>${p.category || ""}</td>
            <td>${p.price || ""}</td>
            <td>${p.stock}</td>
            <td>${p.client ? p.client.name : ""}</td>
            <td><button onclick="deleteProduct(${p.id})">🗑️</button></td>
          </tr>`;
      });
    }

    async function createProduct() {
      const name = document.getElementById("productName").value;
      const category = document.getElementById("productCategory").value;
      const price = document.getElementById("productPrice").value;
      const stock = document.getElementById("productStock").value;
      const client_id = document.getElementById("productClient").value || null;

      await fetch(`${API}/products`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, category, price, stock, client_id })
      });
      loadProducts();
    }

    async function deleteProduct(id) {
      await fetch(`${API}/products/${id}`, { method: "DELETE" });
      loadProducts();
    }

    // ======================= INICIO =========================
    loadClients();
    loadProducts();
  </script>
</body>
</html>
