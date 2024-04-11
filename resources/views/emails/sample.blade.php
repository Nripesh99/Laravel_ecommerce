<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Brought By</th>
            <th scope="col">Product Name</th>
            <th scope="col">quantity</th>
            <th scope="col">Product</th>
        </tr>
    </thead>
    <tbody>
        @php
            $id = 1;
        @endphp
        @foreach ($order as $orders)
        <tr>
            <th scope="row">{{$id}}</th>
            <td>{{$orders->orders->user->name}}</td>
            <td>{{$orders->products->name}}</td>
            <td>{{$orders->quantity}}</td>
            <td>{{$orders->price}}</td>
        </tr>
      
            @php
                $id++;
            @endphp
        @endforeach
    </tbody>
</table>
