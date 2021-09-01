<table>
    <thead>
        <tr>
            <th>TANGGAL BERGABUNG</th>
            <th>ID ANGGOTA</th>
            <th>TIPE ANGGOTA</th>
            <th>NAMA</th>
            <th>JENIS KELAMIN</th>
            <th>TEMPAT, TANGGAL LAHIR</th>
            <th>ALAMAT (KTP)</th>
            <th>PROV (KTP)</th>
            <th>KOTA (KTP)</th>
            <th>ALAMAT (DOM)</th>
            <th>PROV (DOM)</th>
            <th>KOTA (DOM)</th>
            <th>HP</th>
            <th>EMAIL</th>
            <th>PENDIDIKAN TERAKHIR</th>
            <th>PEKERJAAN</th>
            <th>JABATAN</th>
            <th>INDUSTRI</th>
            <th>STATUS</th>
            <th>PELATIHAN</th>
            <th>SERTIFIKASI (BNSP)</th>
        </tr>
    </thead>
    <tbody>
@if(isset($result))
    @foreach($result as $h)
        <tr>
            <td>{{ $h->dt_created }}</td>
            <td>{{ $h->member_id }}</td>
            <td>{{ $h->st_anggota }}</td>
            <td>{{ $h->member_name }}</td>
            <td>{{ $h->sex }}</td>
            <td>{{ $h->dob }}</td>
            <td>{{ $h->address }}</td>
            <td>{{ $h->province }}</td>
            <td>{{ $h->city }}</td>
            <td>{{ $h->address1 }}</td>
            <td>{{ $h->province1 }}</td>
            <td>{{ $h->city1 }}</td>
            <td>{{ $h->phone }}</td>
            <td>{{ $h->email }}</td>
            <td>{{ $h->last_educ }}</td>
            <td>{{ $h->job }}</td>
            <td>{{ $h->position }}</td>
            <td>{{ $h->position_name }}</td>
            <td>{{ $h->active_flag }}</td>
            <td>{{ $h->st_pelatihan }}</td>
            <td>{{ $h->st_bnsp }}</td>
        </tr>
    @endforeach
@endif
    </tbody>
</table>
