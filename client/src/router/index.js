import { createRouter, createWebHistory } from "vue-router";
import LoginPage from "@/views/LoginPage.vue";
import RegisterPage from "@/views/RegisterPage.vue";
import AdminPage from "@/views/AdminPage.vue";
import DoctorPage from "@/views/DoctorPage.vue";
import PatientPage from "@/views/PatientPage.vue";

/* ADMIN */
//components
import DoctorsComponent from "@/components/Admin/Doctors/DoctorsComponent.vue";
import PatientsComponent from "@/components/Admin/Patients/PatientsComponent.vue";
import AppointmentsComponent from "@/components/Admin/AppointmentsComponent.vue";
import RecordsComponent from "@/components/Admin/RecordsComponent.vue";
import ManageUsersComponent from "@/components/Admin/ManageUsers/ManageUsersComponent.vue";

//Doctor Module
import AddDoctors from "@/components/Admin/Doctors/AddDoctors.vue";
import EditDoctors from "@/components/Admin/Doctors/EditDoctors.vue";
import ViewDoctorsRecords from "@/components/Admin/Doctors/ViewDoctorsRecords.vue";

//Patient Module
import AddPatients from "@/components/Admin/Patients/AddPatients.vue";
import EditPatients from "@/components/Admin/Patients/EditPatients.vue";
import ViewPatients from "@/components/Admin/Patients/ViewPatients.vue";

//Manage User Module
import AddUsers from "@/components/Admin/ManageUsers/AddUsers.vue";
import EditUsers from "@/components/Admin/ManageUsers/EditUsers.vue";

/* DOCTORS */
//components
import PatientsComponentD from "@/components/Doctors/Patients/PatientsComponent.vue";
import MyAppointmentsComponent from "@/components/Doctors/MyAppointments/MyAppointmentsComponent.vue";
import RecordsComponentD from "@/components/Doctors/Records/RecordsComponent.vue";

//My Profile Module
import MyProfileComponent from "@/components/Doctors/MyProfile/MyProfile.vue";

//Patient Module
import EditPatientsD from "@/components/Doctors/Patients/EditPatients.vue";
import ViewPatientsD from "@/components/Doctors/Patients/ViewPatients.vue";

//MyAppointment Module
import EditAppointment from "@/components/Doctors/MyAppointments/EditAppointment.vue";

//Edit Module
import EditRecord from "@/components/Doctors/Records/EditRecord.vue";

/* PATIENTS */
//components
import MyRecords from "@/components/Patients/MyRecords/MyRecordsComponent.vue";
import AppointmentComponentP from "@/components/Patients/Appointment/AppointmentComponent.vue";
import RecordsComponentP from "@/components/Patients/Records/RecordsComponent.vue";

//Appointment Module
import BookAppointmentP from "@/components/Patients/Appointment/BookAppointment.vue";

import EditAppointmentP from "@/components/Patients/Appointment/EditAppointment.vue";

const routes = [
  { path: "/", redirect: "/login" },
  { path: "/login", component: LoginPage },
  { path: "/register", component: RegisterPage },

  {
    path: "/admin",
    name: "admin",
    component: AdminPage,
    meta: { requiresAuth: true },
    children: [
      {
        path: "doctors",
        name: "doctors",
        component: DoctorsComponent,
        meta: { requiresAuth: true },
      },

      {
        path: "viewDoctorsRecords",
        name: "viewDoctorsRecords",
        component: ViewDoctorsRecords,
        meta: { requiresAuth: true },
      },

      {
        path: "addDoctors",
        name: "addDoctors",
        component: AddDoctors,
        meta: { requiresAuth: true },
      },

      {
        path: "editDoctors/:id",
        name: "editDoctors",
        component: EditDoctors,
        meta: { requiresAuth: true },
      },

      {
        path: "patients",
        name: "patients",
        component: PatientsComponent,
        meta: { requiresAuth: true },
      },

      {
        path: "addPatients",
        name: "addPatients",
        component: AddPatients,
        meta: { requiresAuth: true },
      },

      {
        path: "editPatients/:id",
        name: "editPatients",
        component: EditPatients,
        meta: { requiresAuth: true },
      },

      {
        path: "viewPatients",
        name: "viewPatients",
        component: ViewPatients,
        meta: { requiresAuth: true },
      },

      {
        path: "appointments",
        name: "appointments",
        component: AppointmentsComponent,
        meta: { requiresAuth: true },
      },

      {
        path: "records",
        name: "records",
        component: RecordsComponent,
        meta: { requiresAuth: true },
      },

      {
        path: "manageUsers",
        name: "manageUsers",
        component: ManageUsersComponent,
        meta: { requiresAuth: true },
      },

      {
        path: "addUsers",
        name: "addUsers",
        component: AddUsers,
        meta: { requiresAuth: true },
      },

      {
        path: "editUsers/:id",
        name: "editUsers",
        component: EditUsers,
        meta: { requiresAuth: true },
      },
    ],
  },

  {
    path: "/doctor",
    name: "doctor",
    component: DoctorPage,
    meta: { requiresAuth: true },
    children: [
      {
        path: "myprofile",
        name: "myprofile",
        component: MyProfileComponent,
        meta: { requiresAuth: true },
      },
      {
        path: "patientsD",
        name: "patientsD",
        component: PatientsComponentD,
        meta: { requiresAuth: true },
      },

      {
        path: "editPatientsD",
        name: "editPatientsD",
        component: EditPatientsD,
        meta: { requiresAuth: true },
      },

      {
        path: "viewPatientsD",
        name: "viewPatientsD",
        component: ViewPatientsD,
        meta: { requiresAuth: true },
      },

      {
        path: "myappointments",
        name: "myappointments",
        component: MyAppointmentsComponent,
        meta: { requiresAuth: true },
      },

      {
        path: "editAppointment/:appointmentId",
        name: "editAppointment",
        component: EditAppointment,
        meta: { requiresAuth: true },
      },

      {
        path: "recordsD",
        name: "recordsD",
        component: RecordsComponentD,
        meta: { requiresAuth: true },
      },

      {
        path: "editRecordsD/:recordId",
        name: "editRecordsD",
        component: EditRecord,
        meta: { requiresAuth: true },
      },
    ],
  },

  {
    path: "/patient",
    name: "patient",
    component: PatientPage,
    meta: { requiresAuth: true },
    children: [
      {
        path: "myRecords",
        name: "myRecords",
        component: MyRecords,
        meta: { requiresAuth: true },
      },

      {
        path: "appointmentsP",
        name: "appointmentsP",
        component: AppointmentComponentP,
        meta: { requiresAuth: true },
      },

      {
        path: "bookAppointmentP",
        name: "bookAppointmentP",
        component: BookAppointmentP,
        meta: { requiresAuth: true },
      },

      {
        path: "editAppointmentP/:id",
        name: "editAppointmentP",
        component: EditAppointmentP,
        meta: { requiresAuth: true },
      },

      {
        path: "recordsP",
        name: "recordsP",
        component: RecordsComponentP,
        meta: { requiresAuth: true },
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("token");
  const userType = localStorage.getItem("userType");

  const isAuthRequired = to.matched.some((record) => record.meta.requiresAuth);
  const isPublicPage = ["/login", "/register"].includes(to.path);

  if (isAuthRequired && !token) {
    next("/login");
  } else if (!token && !isPublicPage) {
    next("/login");
  } else if (to.path === "/home" || to.path === "/home/") {
    if (userType === "Admin") {
      next({ name: "/admin" });
    }

    if (userType === "Doctor") {
      next({ name: "/doctor" });
    }

    if (userType === "Patient") {
      next({ name: "/patient" });
    }
  } else if (to.path === "/home/users" && userType !== "Admin") {
    next({ name: "products" });
  } else {
    next();
  }
});

export default router;

// { path: "/add-product", name: "addProduct", component: AddProduct },
// { path: "/add-user", name: "addUser", component: AddUser },
// {
//   path: "/editproduct/:id",
//   name: "editProduct",
//   component: EditProductComponent,
//   props: true,
// },

// { path: '/cart', name: 'cart', component: CartPage, meta: { requiresAuth: true } },
// { path: '/checkout', name: 'checkout', component: CheckoutPage, meta: { requiresAuth: true } },
// { path: '/buyer', name: 'buyer', component: BuyerPage, meta: { requiresAuth: true } },

// {
//   path: "/editAdminProduct/:id",
//   name: "editAdminProduct",
//   component: EditAdminProduct,
//   props: true,
// },
// {
//   path: "/users",
//   name: "adminUsers",
//   component: AdminUsersPage,
//   meta: { requiresAuth: true },
// },
// {
//   path: "/edituser/:id",
//   name: "editUser",
//   component: EditUserComponent,
//   props: true,
//   meta: { requiresAuth: true },
// },

// {
//   path: "/home",
//   name: "home",
//   component: HomePage,
//   meta: { requiresAuth: true },
//   children: [
//     {
//       path: "",
//       redirect: () => {
//         const userType = localStorage.getItem("userType");
//         if (userType === "Admin") {
//           return { name: "users" };
//         } else {
//           return { name: "products" };
//         }
//       },
//     },

//     {
//       path: "users",
//       name: "users",
//       component: UsersPage,
//       meta: { requiresAuth: true },
//     },
//     {
//       path: "products",
//       name: "products",
//       component: ProductsPage,
//       meta: { requiresAuth: true },
//     },
//   ],
// },
