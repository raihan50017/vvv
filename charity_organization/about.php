<?php
include(__DIR__ . "/common/header.php");
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <div class="">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">Who We Are</h5>
                <p class="card-text">
                    We are more than just a charitable entity, we are a community of caring individuals dedicated to making a difference. Founded on the principles of empathy and solidarity, our organization brings people together from all walks of life, united by a common goal: to uplift the less fortunate and build a world where kindness prevails.
                </p>

                <h5 class="card-title">Our Mission</h5>
                <p class="card-text">
                    Our primary mission is to alleviate suffering and promote well-being among marginalized communities. Through strategic initiatives and collaborative partnerships, we address a variety of pressing issues, including but not limited to education, healthcare, poverty, and environmental sustainability. By tackling these challenges head-on, we strive to create a ripple effect of positive change that extends far beyond the immediate impact.
                </p>
                <h5 class="card-title">What We Do</h5>
                <p>
                    <b>1. Education for All:</b>
                    We believe in the transformative power of education. Our programs focus on providing access to quality education, scholarships, and skill-building opportunities to empower individuals and communities for a brighter future.
                    <br>
                    <br>
                    <b>2. Healthcare Initiatives:</b>
                    Health is a fundamental human right. Through medical outreach programs, awareness campaigns, and healthcare infrastructure support, we aim to improve the well-being of underserved populations.
                    <br>
                    <br>
                    <b>3. Poverty Alleviation:</b>
                    Breaking the cycle of poverty requires a multi-faceted approach. We implement sustainable projects that create employment, offer vocational training, and provide financial assistance to empower individuals to escape poverty.
                    <br>
                    <br>
                    <b>4. Environmental Sustainability:</b>
                    Preserving our planet is integral to creating a better world. Our eco-friendly initiatives focus on conservation, reforestation, and promoting sustainable practices to ensure a healthier environment for future generations.
                </p>
            </div>
        </div>
    </div>

</div>

<?php include(__DIR__ . "/common/footer.php"); ?>