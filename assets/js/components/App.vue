<template>
  <div>
    <Header></Header>

    <Menu></Menu>

    <ContentBlog></ContentBlog>

  </div>
</template>
<script>

import ContentBlog from "./ContentBlog";
import Header from "./Header";
import Menu from "./Menu";
export default {
  name: "app",
  components: {Menu, Header, ContentBlog}
}
</script>
<style scoped>
</style>