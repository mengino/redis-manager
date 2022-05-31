<template>
  <div class="string-form">
    <el-form :model="form" label-width="100px">
      <el-form-item label="Key">
        <el-input v-model="form.key" :disabled="true"></el-input>
      </el-form-item>

      <template v-if="!readonly">
        <el-form-item label="Expire">
          <el-input-number v-model="form.expire" :min="-1"></el-input-number>
        </el-form-item>

        <el-form-item>
          <el-button type="primary" @click="expire()">Update expire</el-button>
        </el-form-item>

        <div class="line"></div>
      </template>

      <el-form-item label="Value">
        <el-input
          id="input"
          type="textarea"
          v-model="form.value"
          :readonly="readonly"
          :rows="20"
        >
        </el-input>
      </el-form-item>
      <el-form-item>
        <el-button v-if="!readonly" type="primary" @click="save()">
          Save
        </el-button>
        <el-button type="success" @click="copy()">Copy</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<style>
.string-form {
  margin-top: 20px;
}
.line {
  height: 1px;
  background-color: #e6e6e6;
  margin: 10px 0 20px 0;
}
</style>
<script>
export default {
  data() {
    return {
      form: {
        key: "",
        expire: -1,
        value: "",
      },
      readonly: true,
    };
  },

  created() {
    document.title = "Redis Manager - Edit string";
    this.readonly = localStorage.getItem("readonly") === "true";
  },

  mounted() {
    this.load(this.$route.query.key);
  },

  methods: {
    copy() {
      var input = document.getElementById("input");
      input.select(); // 选中文本
      document.execCommand("Copy");
      this.$message("已复制好，可贴粘。");
    },

    expire() {
      this.$redis.expire(this.form.key, this.form.expire).then((response) => {
        this.$message({
          type: "success",
          message: "Saved!",
        });
      });
    },

    save(formName) {
      this.$redis
        .set(this.form.key, this.form.value)
        .then((response) => {
          this.$message({
            type: "success",
            message: "Saved!",
          });

          this.$router.push({ path: "/" });
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    load(key) {
      const loading = this.$loading({
        lock: true,
      });

      this.$redis.get(key).then((response) => {
        this.form = response.data;
        loading.close();
      });
    },
  },
};
</script>
