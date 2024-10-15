<section class="position-relative" style="top: -140px">
    <nav aria-label="Page navigation example row pt-5">
        <ul class="pagination justify-content-center col-12">
            <li class="page-item previous" onclick={prevPage} id="next">
                <span class="page-link border-0" aria-label="Previous">
                  <img src="{{ asset('images/icons/left-arrow.svg') }}" />
                </span>
              </li>
          <li class="page-item active" aria-current="page"><span class="page-link border-0 mx-2 mx-md-3 px-3">1</span></li>
          <li class="page-item"><span class="page-link border-0 bg-light mx-2 mx-md-3 px-3">2</span></li>
          <li class="page-item"><a class="page-link border-0 bg-light mx-2 mx-md-3 px-3">3</a></li>
          <li class="page-item"><span class="page-link border-0 bg-light mx-2 mx-md-3 px-3">4</span></li>
          <li class="page-item"><a class="page-link border-0 bg-light mx-2 mx-md-3 px-3">5</a></li>
          <li class="page-item next" id="prev" onclick={nextPage}>
            <span class="page-link border-0" aria-label="Next">
                <img src="{{ asset('images/icons/right-arrow.svg') }}" />
            </span>
          </li>
        </ul>
      </nav>
        <h5 class="text-center text-black calibri pt-4">4 von 20 Referenzen</h5>
</section>
