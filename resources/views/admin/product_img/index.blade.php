<a href="/admin/product_cat/create">Tambah Kategori</a>
    <table border="1">
        <thead>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            
            @foreach($index as $index)
            
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$index['category_name']}}</td>
                <td><form action="/admin/product_cat/{{$index->id}}/edit" method="GET">
                	@csrf
                	<button>Edit</button>
                	</form>

            	</td> 
            </tr>
           @endforeach
        </tbody>
    </table>
