@extends('layout.app')
@section('stylesheets')
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
        .modal-header {
            border-bottom: 2px solid #00bfa5 !important;
            padding: 10px 15px !important;
        }
        .modal-header .close {
            font-size: 27px;
        }
        .modal-body {
            padding: 0px !important;
            text-indent: 15px;
        }
        #searchModal ul {
            list-style-type: none;
            padding: 0px;
        }
        #searchModal li {
            border-bottom: solid 1px RGBA(0, 0, 0, 0.05);
            padding: 10px 0px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div id="map"></div>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#searchModal">Search</button>

    <!-- Modal -->
    <div id="searchModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Schools list</h4>
                </div>
                <div class="modal-body search-modal-body">
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var city = <?php echo json_encode($_GET['city']); ?> ;
        var contentInfo = [];
        var markers = [];
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                zoomControl: false
            });

            var geocoder = new google.maps.Geocoder();

            geocoder.geocode( { 'address': city}, function(results, status) {
                if (status == 'OK') {
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(11);
                }
            });

            var infowindow = new google.maps.InfoWindow({
            });

            $.ajax({
                type: "GET",
                url: '/getSchoolsByCity',
                data: {
                    'city': city,
                    '_token': document.getElementsByTagName("meta")["csrf-token"].getAttribute("content")
                },
                success: function( result ) {
                    var ul = document.createElement('ul');
                    for(var i=0; i<result.schools.results.length; i++) {
                        contentInfo.push(result.schools.results[i].name);
                        var li = document.createElement('li');
                        $(li).append(result.schools.results[i].name).click(function(){
                            for(i=0; i<markers.length; i++){
                                if (i == $(this).index())
                                    markers[i].setVisible(true);
                                else
                                    markers[i].setVisible(false);
                            }
                            $("#searchModal").modal('hide');
                        });
                        $(ul).append(li);

                        var marker = new google.maps.Marker({
                            position: result.schools.results[i].geometry.location,
                            map: map,
                            icon: '/img/marker.png'
                        });
                        marker.number = i;

                        markers.push(marker);

                        marker.addListener('click', function() {
                            infowindow.setContent(contentInfo[this.number]);
                            infowindow.open(map, marker);
                        });
                        google.maps.event.addListener(marker,'mouseover', (function(marker, infowindow){
                            return function() {
                                infowindow.setContent(contentInfo[this.number]);
                                infowindow.open(map, marker);
                            };
                        })(marker, infowindow));
                    }
                    $('.search-modal-body').append(ul);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxY1zoTFo6cA_0ir1GpIS6noqyZM388U8&callback=initMap">
    </script>
@endsection
