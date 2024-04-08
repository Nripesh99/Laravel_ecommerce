<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">
  <h1>Order List</h1>
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Brought By</th>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
          </tr>
      </thead>
      <tbody>
          @php
              $id = 1;
          @endphp
          @foreach($order as $orders)
          <tr>
              <th scope="row">{{$id}}</th>
              <td>Nripesh Parajuli</td>
              <td>Brody Grambel</td>
              <td>14</td>
              <td>231</td>
          </tr>
          @php
              $id++;
          @endphp
          @endforeach
      </tbody>
  </table>
</div>