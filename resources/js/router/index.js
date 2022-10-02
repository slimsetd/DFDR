import Vue from "vue";
import VueRouter from "vue-router";
import store from "../store";
Vue.use(VueRouter);

import HomeLayout from "../layouts/HomeLayout.vue";
import DashboardLayout from "../layouts/DashboardLayout.vue";
import AdminCreateLayout from "../layouts/AdminCreateLayout.vue";
import Homepage from "../pages/Homepage.vue";
import DescSubmission from "../pages/DescSubmission.vue";
import Login from "../pages/Login.vue";
import PdfViewNew from "../pages/PdfView.vue";
import PdfViewOld from "../pages/PdfViewOld.vue";
import ForgotPassword from "../pages/Loginforget.vue";
import ResetPassword from "../pages/LoginReset.vue";
import AllSubmissions from "../pages/SubmissionAll.vue";
import Register from "../pages/Register.vue";
import Contact from "../pages/Contact.vue";
import About from "../pages/About.vue";
import SubmissionFilter from "../pages/SubmissionFilter.vue";
import Detailnews from "../pages/Detailnews.vue";
import DetailSubmission from "../pages/SubmissionDetail.vue";
import SubmissionByCategory from "../pages/SubmissionByCategory.vue";
import SubmissionByTitle from "../pages/SubmissionByTitle.vue";
import SubmissionByYear from "../pages/SubmissionByYear.vue";
import SubmissionByCreator from "../pages/SubmissionByCreator.vue";
import Dashboard from "../pages/Dashboard.vue";
import UserManagement from "../pages/admin/UserManagement.vue";
import UserManagementAdd from "../pages/admin/UserManagementAdd.vue";
import EditorManagement from "../pages/admin/EditorManagement.vue";
import EditorManagementAdd from "../pages/admin/EditorManagementAdd.vue";
import DataBackup from "../pages/admin/DataBackup.vue";
import DataVersion from "../pages/admin/DataVersion.vue";
import MasterCategory from "../pages/admin/MasterCategory.vue";
import MasterDegree from "../pages/admin/MasterDegree.vue";
import MasterDepartment from "../pages/admin/MasterDepartment.vue";
import MasterDivision from "../pages/admin/MasterDivision.vue";
import MasterFaculty from "../pages/admin/MasterFaculty.vue";
import MasterLanguages from "../pages/admin/MasterLanguages.vue";
import MasterNews from "../pages/admin/MasterNews.vue";
import MasterYear from "../pages/admin/MasterYear.vue";
import ReportChart from "../pages/admin/ReportChart.vue";
import ReportChartCategory from "../pages/admin/ReportChartCategory.vue";
import ReportChartEditor from "../pages/admin/ReportChartEditor.vue";
import UserManagementDetail from "../pages/admin/details/UserManagementDetail.vue";
import EditorManagementDetail from "../pages/admin/details/EditorManagementDetail.vue";
import UploadFile from "../pages/users/forms/UploadFile.vue";
import MyUpload from "../pages/users/MyUpload.vue";
import DetailMyUpload from "../pages/users/details/DetailMyupload.vue";
import UploadedFileMonth from "../pages/admin/UploadedListMonth.vue";
import UploadedFile from "../pages/admin/UploadedList.vue";
import UploadedFileRead from "../pages/admin/UploadedListRead.vue";
import UploadedFileDetail from "../pages/admin/UploadedListDetail.vue";
import UploadedFileUser from "../pages/admin/UploadedListUser.vue";
import UploadedFileUserDetail from "../pages/admin/details/UploadedListUserDetail.vue";
import UploadedFileApproved from "../pages/admin/UploadedListApproved.vue";
import DetailUploaded from "../pages/admin/details/DetailUploaded.vue";
import UserProfile from "../pages/UserProfile.vue";
import BulkUser from "../pages/admin/BulkUser.vue";
import BulkEditor from "../pages/admin/BulkEditor.vue";
import ReportPdf from "../pages/admin/ReportPdf.vue";
import ViewJson from "../pages/admin/JsonViewer.vue";
// add by mw
import TemplateHome from "../pages/admin/template/Home.vue"
import TemplateSubmission from "../pages/admin/template/Submission.vue"
import TemplateAbout from "../pages/admin/template/About.vue"
import TemplateContact from "../pages/admin/template/Contact.vue"
import TemplateSlider from "../pages/admin/template/Slider.vue"
import TemplateFooterImage from "../pages/admin/template/FooterImage.vue"

const routes = [{
        path: "",
        component: HomeLayout,
        children: [{
                path: "/",
                component: Homepage,
                name: "Homepage",
            },
            {
                path: "/home",
                component: Homepage,
                name: "Homepage",
            },
            {
                path: "/view/:id",
                component: PdfViewOld,
                name: "PdfView",
            },
            {
                path: "/fullview/:id",
                component: PdfViewNew,
                name: "PdfViewNew",
            },
            {
                path: "/submissions",
                component: DescSubmission,
                name: "DescSubmission",
            },
            {
                path: "/login",
                component: Login,
                name: "Login",
                props: true,
            },
            {
                path: "/forgotPassword",
                component: ForgotPassword,
                name: "ForgotPassword",
                props: true,
            },
            {
                path: "/resetPassword",
                component: ResetPassword,
                name: "ResetPassword",
                props: true,
            },
            {
                path: "/about",
                component: About,
                name: "About",
            },
            {
                path: "/register",
                component: Register,
                name: "Register",
            },
            {
                path: "/contact",
                component: Contact,
                name: "Contact",
            },
            {
                path: "/submission",
                component: SubmissionFilter,
                name: "SubmissionFilter",
            },
            {
                path: "/all-submission",
                component: AllSubmissions,
                name: "AllSubmissions",
            },
            {
                path: "/all-submission/:keySearch",
                component: AllSubmissions,
                name: "AllSubmissions",
                props: true,
            },
            {
                path: "/submission-by-category/:id",
                component: SubmissionByCategory,
                name: "SubmissionByCategory",
                props: true,
            },
            {
                path: "/submission-by-category",
                component: SubmissionByCategory,
                name: "SubmissionByCategory2",
            },
            {
                path: "/submission-by-title",
                component: SubmissionByTitle,
                name: "SubmissionByTitle",
                props: true,
            },
            {
                path: "/submission-by-year",
                component: SubmissionByYear,
                name: "SubmissionByYear",
            },
            {
                path: "/submission-by-creator",
                component: SubmissionByCreator,
                name: "SubmissionByCreator",
            },
            {
                path: "/detail-submissions/:id",
                component: DetailSubmission,
                name: "DetailSubmission",
                props: true,
            },
            {
                path: "/detail-news/:id",
                component: Detailnews,
                name: "Detailnews",
            },
        ],
    },
    {
        path: "/dashboard",
        component: DashboardLayout,
        meta: { requiresAuth: true },
        children: [{
                path: "",
                component: Dashboard,
                name: "Dashboard",
            },
            {
                path: "/user-profile",
                component: UserProfile,
                name: "UserProfile",
            },
            {
                path: "/user-management",
                component: UserManagement,
                name: "UserManagement",
            },
            {
                path: "/editor-management",
                component: EditorManagement,
                name: "EditorManagement",
            },
            {
                path: "/eksport-import-user",
                component: BulkUser,
                name: "BulkUser",
            },
            {
                path: "/eksport-import-editor",
                component: BulkEditor,
                name: "BulkEditor",
            },
            {
                path: "/create-user-management",
                component: UserManagementAdd,
                name: "UserManagementAdd",
            },
            {
                path: "/create-editor-management",
                component: EditorManagementAdd,
                name: "EditorManagementAdd",
            },
            {
                path: "/detail-user-management/:id",
                component: UserManagementDetail,
                name: "UserManagementDetail",
                props: true,
            },
            {
                path: "/detail-editor-management/:id",
                component: EditorManagementDetail,
                name: "EditorManagementDetail",
                props: true,
            },
            {
                path: "/database-backup",
                component: DataBackup,
                name: "DataBackup",
            },
            {
                path: "/version",
                component: DataVersion,
                name: "DataVersion",
            },
            {
                path: "/master-category",
                component: MasterCategory,
                name: "MasterCategory",
            },
            {
                path: "/master-subject",
                component: MasterDegree,
                name: "MasterDegree",
            },
            {
                path: "/master-department",
                component: MasterDepartment,
                name: "MasterDepartment",
            },
            {
                path: "/master-division",
                component: MasterDivision,
                name: "MasterDivision",
            },
            {
                path: "/master-faculty",
                component: MasterFaculty,
                name: "MasterFaculty",
            },
            {
                path: "/master-languages",
                component: MasterLanguages,
                name: "MasterLanguages",
            },
            {
                path: "/master-news",
                component: MasterNews,
                name: "MasterNews",
            },
            {
                path: "/master-year",
                component: MasterYear,
                name: "MasterYear",
            },
            {
                path: "/upload-file",
                component: UploadFile,
                name: "UploadFile",
            },
            {
                path: "/my-upload",
                component: MyUpload,
                name: "MyUpload",
            },
            {
                path: "/detail-my-upload/:id",
                component: DetailMyUpload,
                name: "DetailMyUpload",
                props: true,
            },
            {
                path: "/detail-upload/:id",
                component: DetailUploaded,
                name: "DetailUploaded",
                props: true,
            },
            {
                path: "/all-deposit/",
                component: UploadedFile,
                name: "UploadedFile",
            },
            {
                path: "/all-deposit-read/",
                component: UploadedFileRead,
                name: "UploadedFileRead",
            },
            {
                path: "/deposit-detail/:id",
                component: UploadedFileDetail,
                name: "UploadedFileDetail",
                props: true,
            },
            {
                path: "/month-deposit/",
                component: UploadedFileMonth,
                name: "UploadedFileMonth",
            },
            {
                path: "/all-deposit-user/",
                component: UploadedFileUser,
                name: "UploadedFileUser",
            },
            {
                path: "/all-deposit-user-detail/:id",
                component: UploadedFileUserDetail,
                name: "UploadedFileUserDetail",
            },
            {
                path: "/deposit-approved/",
                component: UploadedFileApproved,
                name: "UploadedFileApproved",
            },
            {
                path: "/report-all-deposit",
                component: ReportChart,
                name: "ReportChart",
            },
            {
                path: "/report-deposit-by-category",
                component: ReportChartCategory,
                name: "ReportChartCategory",
            },
            {
                path: "/report-deposit-by-editor",
                component: ReportChartEditor,
                name: "ReportChartEditor",
            },
            {
                path: "/report-pdf-deposit",
                component: ReportPdf,
                name: "ReportPdf",
            },

            // add by mw
            // home
            {
                path: "/template/home",
                component: TemplateHome,
                name: "TemplateHome",
            },
            {
                path: "/template/submission",
                component: TemplateSubmission,
                name: "TemplateSubmission",
            },
            {
                path: "/template/about",
                component: TemplateAbout,
                name: "TemplateAbout",
            },
            {
                path: "/template/contact",
                component: TemplateContact,
                name: "TemplateContact",
            },
            {
                path: "/template/slider",
                component: TemplateSlider,
                name: "TemplateSlider",
            },
            {
                path: "/template/footer-image",
                component: TemplateFooterImage,
                name: "TemplateFooterImage",
            },
           
        ],
    },
    {
        path: "/adm-config",
        component: AdminCreateLayout,
    }
    ,
    {
        path: "/view-json-deposit/:id",
        component: ViewJson,
        name: "ViewJson",
    },
];

const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return;
        }
        next("/login");
    } else {
        next();
    }
});

export default router;