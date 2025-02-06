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
                        <form id="domainSearchForm" class="position-relative" method="post" action="{{ route('domains.check') }}">
                            @csrf
                            <div class="rts-hero__form-area">
                                <input type="text"
                                       placeholder="find your domain name"
                                       name="domain"
                                       id="domainInput"
                                       value="{{ old('domain', $searchedDomain ?? '') }}"
                                       required>
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
                                        <span>{{ $tld->formattedRegistrationPrice()}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-shape-area">
            <img class="three" src="{{asset('assets/images/banner/banner-bg-element.svg')}}" alt="banner background">
        </div>
    </section>

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
                                        <td class="cell">
                                            @php
                                                $tld = '.' . explode('.', $result['domain_name'], 2)[1];
                                                $pricing = $domains->firstWhere('tld', $tld);
                                            @endphp
                                            {{ $pricing ? $pricing->formattedRegistrationPrice() : 'N/A' }}
                                        </td>
                                        <td class="cell">
                                            @if ($result['is_available'])
                                                <a href="#"
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

    @push('scripts')
        <script>
            $(document).ready(function() {
                const $form = $('#domainSearchForm');
                const $searchResult = $('#searchResult');
                const $alertDiv = $searchResult.find('.alert');
                const $searchButton = $('#searchButton');
                const $domainInput = $('#domainInput');
                const $tldSelect = $('#tldSelect');

                // Helper function to show alerts
                function showAlert(message, type) {
                    $searchResult.show();
                    $alertDiv.removeClass().addClass(`alert alert-${type}`).text(message);
                }

                // Form submission handler
                $form.on('submit', function(e) {
                    e.preventDefault();

                    const domainName = $domainInput.val().trim().toLowerCase();
                    if (!domainName) {
                        showAlert('Please enter a domain name', 'danger');
                        return;
                    }

                    // Combine domain name and TLD
                    const fullDomain = `${domainName}.${$tldSelect.val()}`;

                    // Disable button and show loading state
                    $searchButton.prop('disabled', true)
                        .html('<i class="fas fa-spinner fa-spin"></i> Searching...');

                    // Make the AJAX request
                    $.ajax({
                        url: '{{ route('domains.search') }}',
                        method: 'POST',
                        data: JSON.stringify({ domain: fullDomain }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.error) {
                                showAlert(data.error, 'danger');
                            } else {
                                const price = data.price ?
                                    ` - Price: ${new Intl.NumberFormat('rw-RW', {
                                        style: 'currency',
                                        currency: 'RWF'
                                    }).format(data.price)}` : '';

                                const message = data.available ?
                                    `Domain ${data.domain} is available!${price}` :
                                    `Domain ${data.domain} is not available. ${data.reason || ''}`;

                                showAlert(message, data.available ? 'success' : 'warning');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error:', errorThrown);
                            showAlert('An error occurred while checking the domain.', 'danger');
                        },
                        complete: function() {
                            // Re-enable button and restore original text
                            $searchButton.prop('disabled', false)
                                .text('Search');
                        }
                    });
                });

                // Domain input validation
                $domainInput.on('input', function(e) {
                    const value = $(this).val().trim();
                    if (!value) return;

                    const isValid = /^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]$/.test(value);
                    this.setCustomValidity(
                        isValid ? '' :
                            'Domain name can only contain letters, numbers, and hyphens, and cannot start or end with a hyphen.'
                    );

                    if (!isValid) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
