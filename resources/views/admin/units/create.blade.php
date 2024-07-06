
<x-layout>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Unit Form</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div> -->
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">New Unit</h3>
                        </div>
                       
                        <form action="{{route('unit.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="unit_name">Unit Name</label>
                                    <input name="unit_name" value="{{old('unit_name')}}" type="text" class="form-control" id="unit_name"
                                        placeholder="Enter Unit Name">
                                </div>
                                @error('unit_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="unit_desc">Unit Description</label>
                                    <textarea name="unit_desc" class="form-control" id="unit_desc" rows="5" cols="">{{old('unit_desc')}}</textarea>
                                </div>
                                @error('seo_meta_desc')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Unit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
