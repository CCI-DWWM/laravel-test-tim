@extends('layouts.app')

@section('title', 'Liste des Produits')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-boxes me-2"></i>Liste des Produits
            </h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un produit
            </a>
        </div>

        @if($products->count() > 0)
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <strong>{{ $product->name }}</strong>
                                        </td>
                                        <td>
                                            @if($product->description)
                                                {{ Str::limit($product->description, 50) }}
                                            @else
                                                <span class="text-muted">Aucune description</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ number_format($product->price, 2) }} €</span>
                                        </td>
                                        <td>
                                            @if($product->stock > 10)
                                                <span class="badge bg-success">{{ $product->stock }}</span>
                                            @elseif($product->stock > 0)
                                                <span class="badge bg-warning">{{ $product->stock }}</span>
                                            @else
                                                <span class="badge bg-danger">Rupture</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('products.show', $product) }}" 
                                                   class="btn btn-sm btn-outline-info" 
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('products.edit', $product) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('products.destroy', $product) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Aucun produit trouvé</h4>
                <p class="text-muted">Commencez par ajouter votre premier produit.</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Ajouter un produit
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
