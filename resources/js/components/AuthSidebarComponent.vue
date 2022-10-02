<template>
  <div>
    <div id="accordion">
      <div class="card">
        <div
          id="headingAuth"
          class="card-header"
          data-toggle="collapse"
          data-target="#collapseAuth"
          aria-expanded="true"
          aria-controls="collapseAuth"
          style="cursor: pointer"
        >
          <h5>
            <p class="float-left mb-0" style="margin: 0; padding: 0;">
              My Account
            </p>
          </h5>
        </div>

        <div
          id="collapseAuth"
          class="collapse show"
          aria-labelledby="headingAuth"
          data-parent="#accordion"
        >
          <div class="card-body" style="padding: 0; margin: 0;">
            <ul class="nav-ul" style="padding: 0; margin: 0;">
              <li>
                <router-link :to="{ name: 'Login' }" class="nav-link"
                  >Login</router-link
                >
              </li>
              <li>
                <router-link :to="{ name: 'Register' }" class="nav-link"
                  >Register</router-link
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
