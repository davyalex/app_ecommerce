<style>
    .card-vendor {
        padding: 1rem;
        background-color: #fff;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        /* max-width: 320px; */
        border-radius: 20px;
      width:100%;
      margin-bottom: 15px
    }

    .title {
        display: flex;
        align-items: center;
    }

    .title span {
        position: relative;
        padding: 0.5rem;
        background-color: #000000;
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 9999px;
    }

    .title span svg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #ffffff;
        height: 1rem;
    }

    .title-text {
        margin-left: 0.5rem;
        color: #374151;
        font-size: 18px;
        font-weight: 600
    }

    .percent {
        margin-left: 0.5rem;
        color: #121212;
        font-weight: 600;
        display: flex;
        font-size: 16px
    }

    .data {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .data p {
        margin-top: 1rem;
        margin-bottom: 1rem;
        color: #1F2937;
        font-size: 2.25rem;
        line-height: 2.5rem;
        font-weight: 700;
        text-align: left;
    }

    

   
</style>





<div class="row">
    <div class="card-vendor col-md-6 col-sm-12 col-lg-6 border border-dark">
        <div class="title">
          
               <i class="bi bi-currency-dollar"></i>
            <p class="title-text">
                Commandes
            </p>
            <p class="percent">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" fill="currentColor" height="20"
                    width="20">
                    <path
                        d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                    </path>
                </svg>  {{$orders_attente}} en attente(s)
            </p>
        </div>
        <div class="data">
            <p>
                {{$orders->count()}} en total
            </p>
          
            <a href="{{route('vendor-order')}}" class="btn btn-dark"><i class="bi bi-eye"></i> Voir</a>
           
    
        </div>
    </div>

    {{-- <div class="card-vendor col-md-6 col-sm-12 col-lg-6 border border-dark">
        <div class="title">
            <i class="bi bi-cart"></i>
            <p class="title-text">
                Produits
            </p>
            
        </div>
        <div class="data">
            <p>
                39,500
            </p>
            <a href="" class="btn btn-dark"><i class="bi bi-eye"></i> Voir</a>
        </div>
    </div> --}}
</div>




