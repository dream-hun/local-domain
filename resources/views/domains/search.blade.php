<x-app-layout>
    <!-- HERO BANNER ONE -->
    <section class="rts-hero-three rts-hero__one rts-hosting-banner domain-checker-padding banner-default-height">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="rts-hero__content domain">
                        <h1 data-sal="slide-down" data-sal-delay="100" data-sal-duration="800" class="sal-animate">Find Best
                            Unique Domains
                            Checker!
                        </h1>
                        <p class="description sal-animate" data-sal="slide-down" data-sal-delay="200"
                            data-sal-duration="800">Web
                            Hosting, Domain Name and Hosting Center Solutions</p>
                        <form id="domainSearchForm" action="{{ route('domains.check') }}" method="POST" data-sal-delay="300"
                            data-sal-duration="800">
                            @csrf
                            <div class="rts-hero__form-area">
                                <input type="text" placeholder="find your domain name" name="domain" id="domainInput" 
                                       value="{{ old('domain', $searchedDomain ?? '') }}" required>
                                <div class="select-button-area">
                                    <select name="tld" id="tldSelect" class="price__select">
                                        @foreach ($tlds as $tld)
                                            <option value="{{ $tld->tld }}"
                                                {{ old('tld', $searchedTld ?? '') == $tld->tld ? 'selected' : '' }}>
                                                .{{ $tld->tld }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" id="searchButton" class="rts-btn">Search</button>
                                </div>
                            </div>
                        </form>

                        <!-- Search Results Container -->
                        <div id="searchResult" class="mt-4" style="display: none;">
                            <div class="alert"></div>
                        </div>

                        <!-- Domain Pricing -->
                        <div class="banner-content-tag" data-sal-delay="400" data-sal-duration="800">
                            <p class="desc">Popular Domain:</p>
                            <ul class="tag-list">
                                @foreach ($tlds as $tld)
                                    <li>
                                        <span>.{{ $tld->tld }}</span>
                                        <span>{{ number_format($tld->register_price, 2) }} RWF</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-shape-area">
            <img class="three" src="assets/images/banner/banner-bg-element.svg" alt="">
        </div>
    </section>

    @if (isset($domains))
        <!-- DOMAIN PRICING -->
        <section class="rts-domain-pricing-area area-2 pt--120 pb--120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="section-title-area w-550">
                        <h2 class="section-title">Domain Price List</h2>
                        <p class="desc">Keep in mind that TLD prices can change over time, and different
                            registrars may offer different deals and packages
                        </p>
                    </div>
                </div>
                <div class="section-inner">
                    <div class="pricing-table-area">
                        @if (session('error'))
                            <div class="alert alert-danger mt-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (isset($searchResults))
                            <div class="tab__content open" id="all">
                                <table class="table table-hover table-responsive">
                                    <thead class="heading__bg">
                                        <tr>
                                            <th>Domain Name</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table__content">
                                        @foreach ($searchResults as $result)
                                            <tr>
                                                <td class="cell">{{ $result['domain_name'] }}</td>
                                                <td class="cell">
                                                    @if ($result['is_available'])
                                                        <span class="badge bg-success">Available</span>
                                                    @else
                                                        <span class="badge bg-danger">Not Available</span>
                                                    @endif
                                                </td>
                                                <td class="cell"> @php
                                                    $tld = '.' . explode('.', $result['domain_name'], 2)[1];
                                                    $pricing = $domains->firstWhere('tld', $tld);
                                                @endphp
                                                    {{ $pricing ? $pricing->formattedRegistrationPrice() : 'N/A' }}
                                                </td>
                                                <td class="cell">
                                                    @if ($result['is_available'])
                                                        <a href="/cart/add?domain={{ urlencode($result['domain_name']) }}"
                                                            class="rts-btn btn-small">Register Now</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    @endif

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('domainSearchForm');
                const searchResult = document.getElementById('searchResult');
                const alertDiv = searchResult.querySelector('.alert');
                const searchButton = document.getElementById('searchButton');
                const domainInput = document.getElementById('domainInput');
                const tldSelect = document.getElementById('tldSelect');

                // Initialize nice-select if it exists
                if ($.fn.niceSelect) {
                    $('#tldSelect').niceSelect();
                }

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const domainName = domainInput.value.trim().toLowerCase();
                    if (!domainName) {
                        searchResult.style.display = 'block';
                        alertDiv.className = 'alert alert-danger';
                        alertDiv.textContent = 'Please enter a domain name';
                        return;
                    }

                    searchButton.disabled = true;
                    searchButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';

                    fetch('{{ route('domains.check') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            domain: domainName,
                            tld: tldSelect.value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        searchResult.style.display = 'block';
                        
                        if (!data.success) {
                            alertDiv.className = 'alert alert-danger';
                            alertDiv.textContent = data.error || 'An error occurred while checking the domain.';
                            return;
                        }

                        const results = data.results;
                        if (!results || !Array.isArray(results)) {
                            alertDiv.className = 'alert alert-danger';
                            alertDiv.textContent = 'Invalid response format from server';
                            return;
                        }

                        // Create results HTML with the new styling
                        let resultsHtml = `
                            <table class="table table-hover table-responsive">
                                <thead class="heading__bg">
                                    <tr>
                                        <th>Domain Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table__content">
                        `;

                        results.forEach(result => {
                            const status = result.is_available ? 
                                '<span class="badge bg-success">Available</span>' : 
                                '<span class="badge bg-danger">Not Available</span>';
                            const action = result.is_available ? 
                                `<a href="{{ route('domains.register.form') }}?domain=${encodeURIComponent(result.domain_name)}" class="rts-btn btn-small">Register Now</a>` : 
                                '';
                            
                            resultsHtml += `
                                <tr>
                                    <td class="cell">${result.domain_name}</td>
                                    <td class="cell">${status}</td>
                                    <td class="cell">${action}</td>
                                </tr>
                            `;
                        });

                        resultsHtml += `
                                </tbody>
                            </table>
                        `;

                        alertDiv.innerHTML = resultsHtml;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        searchResult.style.display = 'block';
                        alertDiv.className = 'alert alert-danger';
                        alertDiv.textContent = 'An error occurred while checking the domain.';
                    })
                    .finally(() => {
                        searchButton.disabled = false;
                        searchButton.innerHTML = 'Search';
                    });
                });

                // Add input validation
                domainInput.addEventListener('input', function(e) {
                    const value = e.target.value.trim();
                    const isValid = /^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]$/.test(value) && value.length >= 3 && value.length <= 63;
                    if (!isValid && value) {
                        e.target.setCustomValidity(
                            'Domain name must be 3-63 characters long, can only contain letters, numbers, and hyphens, and cannot start or end with a hyphen.'
                        );
                    } else {
                        e.target.setCustomValidity('');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
