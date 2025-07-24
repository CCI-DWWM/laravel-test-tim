@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Détails du produit
                    </h4>
                    <div class="btn-group" role="group">
                        <a href="{{ route('products.edit', $product) }}" 
                           class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title text-primary">
                            <i class="fas fa-tag me-2"></i>{{ $product->name }}
                        </h5>
                        
                        @if($product->description)
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1"></i>Description :
                                </label>
                                <p class="text-muted">{{ $product->description }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-euro-sign me-1"></i>Prix :
                                    </label>
                                    <div class="h4 text-success mb-0">
                                        {{ number_format($product->price, 2) }} €
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-boxes me-1"></i>Stock :
                                    </label>
                                    <div class="h4 mb-0">
                                        @if($product->stock > 10)
                                            <span class="badge bg-success fs-6">{{ $product->stock }}</span>
                                        @elseif($product->stock > 0)
                                            <span class="badge bg-warning fs-6">{{ $product->stock }}</span>
                                        @else
                                            <span class="badge bg-danger fs-6">Rupture</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar me-1"></i>Date de création :
                            </label>
                            <p class="text-muted mb-0">
                                {{ $product->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-edit me-1"></i>Dernière modification :
                            </label>
                            <p class="text-muted mb-0">
                                {{ $product->updated_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 